<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    function showLoginForm(){
        if(Session::has('admin')){
            return redirect()->back();
        }
        return view('admin.pages.login');
    }

    function showSignupForm(){
        if(Session::has('admin')){
            return redirect()->back();
        }
        return view('admin.pages.signup');
    }

    function addUser(Request $request){
        $this->validate($request, [
            'username' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ]);

        // dd($request);

        $result = DB::table('users')
        ->insert([
            'username'=>$request->input('username'),
            'email'=>$request->input('email'),
            'password'=> Hash::make($request->input('password')),
        ]);

        if(!$result){

            return redirect()->back()->with('failed','Registration failed.');
        }
        return redirect()->back()->with('success', 'Registration Successful.');
    }

    function authUser(Request $request){
        //validate requests
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // $currentRouteName = request()->route()->getName();

        $data = DB::table('users')->select('id','username','email','password')->where('email',$request->input('email'))->first();
        
        if($data){
            if (Hash::check($request->input('password'), $data->password)) {
                $userInfo = [
                    'id'=>$data->id,
                    'username'=>$data->username,
                    'email'=>$data->email,
                    'role'=>'admin',
                ];
                // return $userInfo;
                Session::put('admin', $userInfo);
                return redirect()->route('admin.dashboard');
            }
        }

        return redirect()->back()->with('failed', "Login failed!");

    }


    function showSellProductPage(){
        $products = DB::table('products')
        ->where('user_id',Session::get('admin')['id'])
        ->inRandomOrder()
        ->get();
        return view('admin.pages.sale_product',compact('products'));
    }

    function sellProduct(Request $request){
        $product = DB::table('products')->where('id', $request->input('id'))->first();
        // return $product->price * $request->input('quantity');
        $result = DB::table('sales')->insert([
            'user_id' => $product->user_id,
            'product_id' => $request->input('id'),
            'unit_price' => $product->discount ? $product->discount_price:$product->price,
            'quantity' => $request->input('quantity'),
            'payable_amount' => $product->discount ? ($product->discount_price * $request->input('quantity')):($product->price * $request->input('quantity'))
        ]);
        if($result){
            DB::table('products')->where('id', $request->input('id'))->decrement('quantity',$request->input('quantity'));
            return redirect()->back()->with('success',$product->name." x ".$request->input('quantity')." sold.");
        }

        return redirect()->back()->with('failed','Transaction failed. Please try again');
    }

    function showDashboard(){

        $todaySales = DB::table('sales')
        ->where('user_id',Session::get('admin')['id'])
        ->whereDate('created_at', Carbon::today('Asia/Dhaka'))
        ->sum('payable_amount');


        $yesterdaySales = DB::table('sales')
        ->where('user_id',Session::get('admin')['id'])
        ->whereDate('created_at', Carbon::yesterday('Asia/Dhaka'))
        ->sum('payable_amount');

        $thisMonthSales = DB::table('sales')
        ->where('user_id',Session::get('admin')['id'])
        ->whereYear('created_at', now()->year)
        ->whereMonth('created_at', now()->month)
        ->sum('payable_amount');

        $lastMonthSales = DB::table('sales')
        ->where('user_id',Session::get('admin')['id'])
        ->whereYear('created_at', now()->subMonth()->year)
        ->whereMonth('created_at', now()->subMonth()->month)
        ->sum('payable_amount');

        $salesReport = [
            'today'=>$todaySales,
            'Yesterday'=>$yesterdaySales,
            'thisMonth'=>$thisMonthSales,
            'lastMonth'=>$lastMonthSales
        ];

        // notify()->success('Laravel Notify is awesome!');
        // dd($salesReport);

        return view('admin.pages.home',compact('salesReport'));
    }

    function showProducts(){
        $products = DB::table('products')
        ->where('user_id', '=', Session::get('admin')['id'])
        ->get();
        // dd($products);
        return view('admin.pages.products',compact('products'));
    }
    function showSells(){
        $sales = DB::table('sales')
        ->join('products','sales.product_id','=','products.id')
        ->select('sales.id','sales.quantity as sale_quantity','sales.unit_price as price','sales.payable_amount','products.name as product_name','products.image as product_image','products.discount','products.discount_price','sales.created_at')
        ->where('sales.user_id', Session::get('admin')['id'])
        ->get();

        // dd($sales);


        return view('admin.pages.sales',compact('sales'));
    }

    function showAddProductPage(){
        return view('admin.pages.add_product');
    }

    function showEditProductPage($id){
        $product = DB::table('products')->where('id', $id)->first();
        return view('admin.pages.edit_product',compact('product'));
    }

    function editProduct(Request $request){
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpg,jpeg,png|max:10000',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'discount' => 'nullable|boolean',
            'discount_price' => 'nullable|numeric|min:0',
        ]);
// dd($request);

        $imageName = $request->input('old_image');
        if($request->hasFile('image')){
            unlink(public_path($imageName));
            $image = $request->file('image');
            $imageName = 'assets/products/'.md5(uniqid()).time().'.'.$image->getClientOriginalExtension();
            
        }
        $result = DB::table('products')
        ->where('id',$request->input('id'))
        ->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imageName,
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'discount' => $request->input('discount'),
            'discount_price' => $request->input('discount_price')
        ]);

        if($result && $request->hasFile('image')){
            $image->move(public_path('assets/products'), $imageName);
            return redirect()->back()->with('success', "Product updated successfully.");
        }elseif($result && !$request->hasFile('image')){
            return redirect()->back()->with('success', "Product updated successfully.");
        }else{
            return redirect()->back()->with('failed', "Failed to update Product.");
        }
    }

    function addProduct(Request $request){
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:10000',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'discount' => 'nullable|boolean',
            'discount_price' => 'nullable|numeric|min:0',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = md5(uniqid()).time().'.'.$image->getClientOriginalExtension();
        }

        // dd($request);
        // return $request->input('discount_price')?$request->input('discount_price'):null;

        $result = DB::table('products')->insert([
            'user_id'=>Session::get('admin')['id'],
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => 'assets/products/'.$imageName,
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'discount' => $request->input('discount'),
            'discount_price' => $request->input('discount_price'),
        ]);


        if(!$result){
            return redirect()->back()->with('failed', "Failed! Product couldn't be successfully added.");
        }

        $image->move(public_path('assets/products'), $imageName);
        return redirect()->back()->with('success', "Product added successfully.");
    }

    function deleteProduct($id){
        $product = DB::table('products')->where('id', $id)->first();
        $delete = DB::table('products')->where('id', $id)->delete();

        if(!$delete){
            return redirect()->back()->with('failed', "Failed! Product couldn't be deleted.");
        }

        unlink(public_path($product->image));
        return redirect()->back()->with('success', "Product deleted.");
    }

    function destroy(){
        $user = Session::get('admin');
        if($user){
            Session::forget('admin');
        }
        return redirect()->route('admin.login');
    }
}
