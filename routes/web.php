<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('admin.login');
});


// Route::group(['prefix'=>'user'], function () {
//     Route::get('/login',[UserController::class, 'showLoginForm'])->name('user.login');
//     Route::post('/login',[UserController::class, 'authUser'])->name('user.login');
//     Route::get('/signup',[UserController::class, 'showSignupForm'])->name('user.signup');
//     Route::post('/signup',[UserController::class, 'registerUser'])->name('user.signup');
//     Route::post('/buyProduct',[UserController::class, 'buyProduct'])->name('user.buyProduct');
//   });
  
//   Route::middleware('auth.user')->prefix('user')->group(function () {
//     Route::get('/dashboard',[UserController::class, 'showDashboard'])->name('user.dashboard');
// });

  Route::middleware('auth.admin')->prefix('admin')->group(function () {
    // Route::get('/login',[AdminController::class, 'showLoginForm'])->name('admin.login');
    // Route::post('/login',[AdminController::class, 'authUser'])->name('admin.login');
    Route::get('/dashboard',[AdminController::class, 'showDashboard'])->name('admin.dashboard');
    Route::get('/products',[AdminController::class, 'showProducts'])->name('admin.products');
    Route::get('/sales',[AdminController::class, 'showSells'])->name('admin.sales');

    Route::get('/addProduct',[AdminController::class, 'showAddProductPage'])->name('admin.add-product');
    Route::post('/addProduct',[AdminController::class, 'addProduct'])->name('admin.add-product');

    Route::get('/sellProduct',[AdminController::class, 'showSellProductPage'])->name('admin.sellProduct');
    Route::post('/sellProduct',[AdminController::class, 'sellProduct'])->name('admin.sellProduct');


    Route::get('/editProduct/{id}',[AdminController::class, 'showEditProductPage'])->name('admin.editProduct');
    Route::post('/updateProduct',[AdminController::class, 'editProduct'])->name('admin.updateProduct');
    
    Route::delete('/deleteProduct/{id}',[AdminController::class, 'deleteProduct'])->name('admin.deleteProduct');
  });

Route::post('/logout',[AdminController::class, 'destroy'])->name('logout');

Route::group(['prefix'=>'admin'], function () {
    Route::get('/login',[AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login',[AdminController::class, 'authUser'])->name('admin.login');

    Route::get('/signup',[AdminController::class, 'showSignupForm'])->name('admin.signup');
    Route::post('/signup',[AdminController::class, 'addUser'])->name('admin.signup');
});