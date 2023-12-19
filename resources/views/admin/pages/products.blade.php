@extends('admin.layouts.app')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Products</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="orderList">
                            <div class="card-header border-0">
                                <div class="row g-4">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('admin.add-product') }}" class="btn btn-primary"
                                                id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add
                                                Product</a>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control" id="searchProductList"
                                                    placeholder="Search Products...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                @if (session('success'))
                                    <!-- Success Alert -->
                                    <div class="alert alert-success alert-border-left alert-dismissible fade show"
                                        role="alert">
                                        <i class="ri-check-double-line me-3 align-middle"></i> {{ session('success') }}

                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>

                                    </div>
                                @endif

                                @if (session('failed'))
                                    <!-- Danger Alert -->
                                    <div class="alert alert-danger alert-border-left alert-dismissible fade show"
                                        role="alert">

                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div>
                                    <ul class="nav nav-tabs nav-tabs-custom nav-primary mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active All py-3" data-bs-toggle="tab" id="All"
                                                href="#home1" role="tab" aria-selected="true">
                                                <i class="ri-store-2-fill me-1 align-bottom"></i> All Products
                                            </a>
                                        </li>

                                    </ul>

                                    <div class="table-responsive table-card mb-1">
                                        <table class="table table-nowrap align-middle" id="orderTable">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">

                                                    <th class="sort text-center" data-sort="id">Product ID</th>
                                                    <th class="sort" data-sort="product">Product</th>
                                                    <th class="sort text-center" data-sort="product_desc">Description</th>
                                                    <th class="sort text-center" data-sort="price">Price</th>
                                                    <th class="sort text-center" data-sort="price">Discount</th>
                                                    <th class="sort text-center" data-sort="price">Discount Price</th>
                                                    <th class="sort text-center" data-sort="stock">Stock</th>
                                                    <th class="sort text-center" data-sort="published">Published</th>
                                                    {{-- <th class="sort" data-sort="status">Delivery Status</th> --}}
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($products as $product)
                                                    <tr>

                                                        <td class="id text-center">
                                                            <p class="fw-medium link-primary">#<span
                                                                    id="product-id">{{ $product->id }}</span></p>
                                                        </td>
                                                        <td class="product"><span>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-shrink-0 me-3">
                                                                        <div class="avatar-sm bg-light rounded p-1"><img
                                                                                src="{{ asset($product->image) }}"
                                                                                alt="Product-Img" class="img-fluid d-block">
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <h5 class="fs-14 mb-1" id="product-name">
                                                                            {{ $product->name }}</h5>

                                                                    </div>
                                                                </div>
                                                            </span></td>
                                                        <td class="product_desc text-center" id="product-desc">
                                                            {{ $product->description }}</td>
                                                        <td class="price text-center" id="product-price">
                                                            ${{ $product->price }}</td>
                                                        <td class="price text-center" id="product-discount">
                                                            {{ $product->discount == 0 ? 'False' : 'True' }}
                                                        </td>
                                                        <td class="price text-center" id="product-discount-price">
                                                            ${{ $product->discount_price ? $product->discount_price : 0 }}
                                                        </td>
                                                        <td class="stock text-center" id="product-qty">
                                                            {{ $product->quantity }}</td>
                                                        @php
                                                            $carbonDate = \Carbon\Carbon::parse($product->updated_at);
                                                            $date = $carbonDate->format('d M, Y');
                                                            $time = $carbonDate->format('h:i A');
                                                        @endphp
                                                        <td class="date text-center">{{ $date }}, <small
                                                                class="text-muted">{{ $time }}</small>
                                                        </td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">

                                                                <li class="list-inline-item edit" title="Edit">
                                                                    <a href="{{ route('admin.editProduct', $product->id) }}"
                                                                        class="text-primary d-inline-block edit-item-btn">
                                                                        <i class="ri-pencil-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                                <form
                                                                    action="{{ route('admin.deleteProduct', $product->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <li class="list-inline-item" title="Delete">
                                                                        <button type="submit"
                                                                            class="text-danger d-inline-block remove-item-btn bg-transparent border-0">
                                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                        </button>
                                                                    </li>
                                                                </form>
                                                                {{-- <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                    data-bs-trigger="hover" data-bs-placement="top"
                                                                    title="Remove">
                                                                    <a class="text-danger d-inline-block remove-item-btn"
                                                                        data-bs-toggle="modal" href="#deleteOrder">
                                                                        <input type="hidden" name="p-id">
                                                                        <input type="hidden" name="p-id"
                                                                            id="modalInput" value="Hello">
                                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                    </a>
                                                                </li> --}}
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        @if ($products->isEmpty())
                                            <div class="noresult" style="display: block">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                        colors="primary:#25a0e2,secondary:#0ab39c"
                                                        style="width:75px;height:75px">
                                                    </lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                    <p class="text-muted">We've searched in the database but did
                                                        not find any
                                                        products for you search.</p>
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                </div>
                                <div class="modal fade" id="showModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light p-3">
                                                <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close" id="close-modal"></button>
                                            </div>
                                            <form class="tablelist-form" autocomplete="off">
                                                <div class="modal-body">
                                                    <input type="hidden" id="id-field" id="orderId" />

                                                    <div class="mb-3">
                                                        <label for="customername-field" class="form-label">Name</label>
                                                        <input type="text" id="name-field" name="name"
                                                            class="form-control" placeholder="Product name" required />
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="customername-field"
                                                            class="form-label">Description</label>
                                                        <input type="text" id="desc-field" name="description"
                                                            class="form-control" placeholder="Description" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="customername-field" class="form-label">Image</label>
                                                        <input type="file" id="image-field" name="image"
                                                            class="form-control" placeholder="Image" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="customername-field" class="form-label">Price</label>
                                                        <input type="text" id="price-field" name="price"
                                                            class="form-control" placeholder="0" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="customername-field"
                                                            class="form-label">Quantity</label>
                                                        <input type="text" id="quantity-field" name="quantity"
                                                            class="form-control" placeholder="0" required />
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="productname-field" class="form-label">Discount</label>
                                                        <select class="form-control" data-trigger name="productname-field"
                                                            id="discount-field" name="discount" required />
                                                        <option value="false">False</option>
                                                        <option value="true">True</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="date-field" class="form-label">Discount Price</label>
                                                        <input type="text" id="discount-ptice-field"
                                                            class="form-control" name="discount_price" placeholder="0"
                                                            required />
                                                    </div>




                                                </div>
                                                <div class="modal-footer">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success"
                                                            id="add-btn">Update</button>
                                                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body p-5 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#25a0e2,secondary:#00bd9d"
                                                    style="width:90px;height:90px"></lord-icon>
                                                <div class="mt-4 text-center">
                                                    <h4>You are about to delete a product ?</h4>
                                                    <p class="text-muted fs-15 mb-4">Deleting a product will remove
                                                        all of
                                                        the information from database.</p>
                                                    <div class="hstack gap-2 justify-content-center remove">
                                                        <button
                                                            class="btn btn-link link-primary fw-medium text-decoration-none"
                                                            id="deleteRecord-close" data-bs-dismiss="modal"><i
                                                                class="ri-close-line me-1 align-middle"></i>
                                                            Close</button>
                                                        <button class="btn btn-primary" id="delete-record">Yes,
                                                            Delete It</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end modal -->

                                {{-- @include('admin.components.delete_modal') --}}
                            </div>
                        </div>

                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        @include('admin.components.footer')
    </div>
    <!-- end main content-->
@endsection
