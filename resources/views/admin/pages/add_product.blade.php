@extends('admin.layouts.app')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Create Product</h4>


                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <form id="createproduct-form" method="POST" action="{{ route('admin.add-product') }}" autocomplete="off"
                    class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="card">
                                <div class="card-body">
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
                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">Name</label>
                                        <input type="text" id="name-field" name="name" class="form-control"
                                            placeholder="Product name" required />
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">Description</label>
                                        <input type="text" id="desc-field" name="description" class="form-control"
                                            placeholder="Description" required />
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">Image</label>
                                        <input type="file" id="image-field" name="image" class="form-control"
                                            placeholder="Image" required />
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">Price</label>
                                        <input type="text" id="price-field" name="price" class="form-control"
                                            placeholder="0" required />
                                        @error('price')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">Quantity</label>
                                        <input type="text" id="quantity-field" name="quantity" class="form-control"
                                            placeholder="0" required />
                                        @error('quantity')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="productname-field" class="form-label">Discount</label>
                                        <select class="form-control" data-trigger id="discount-field" name="discount"
                                            required />
                                        <option value="0">False</option>
                                        <option value="1">True</option>
                                        </select>
                                        @error('discount')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="date-field" class="form-label">Discount Price</label>
                                        <input type="text" id="discount-ptice-field" class="form-control"
                                            name="discount_price" placeholder="0" required />
                                        @error('discount_price')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->

                            <div class="text-end mb-3">
                                <button type="submit" class="btn btn-primary w-sm">Add Product</button>
                            </div>
                        </div>
                        <!-- end col -->


                    </div>
                    <!-- end row -->

                </form>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        @include('admin.components.footer')
    </div>
    <!-- end main content-->
@endsection
