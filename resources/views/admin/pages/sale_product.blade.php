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
                    @if (session('success'))
                        <div class="col-12">
                            <!-- Success Alert -->
                            <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                <i class="ri-check-double-line me-3 align-middle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>

                            </div>
                        </div>
                    @elseif (session('failed'))
                        <div class="col-12">
                            <!-- Success Alert -->
                            <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                <i class="ri-check-double-line me-3 align-middle"></i> {{ session('success') }} <a
                                    href="{{ route('user.login') }}" class="alert-link">Login</a>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>

                            </div>
                        </div>
                    @endif

                    @foreach ($products as $product)
                        <div class="col-sm-6 col-xl-3">

                            <!-- Simple card -->
                            <div class="card">
                                <img class="card-img-top img-fluid" src="{{ asset($product->image) }}" alt="Product-Img"
                                    style="width: 100%; height: 200px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <h4 class="card-title mb-2">{{ $product->name }}</h4>
                                        </div>
                                        <div class="col-4">
                                            @if ($product->discount)
                                                <div class="text-lg-end">
                                                    <h5 class="fs-14 text-decoration-line-through">$<span
                                                            class="product-price">{{ $product->price }}</span>
                                                    </h5>
                                                </div>
                                            @else
                                                <div class="text-lg-end">
                                                    <h5 class="fs-14">$<span
                                                            class="product-price">{{ $product->price }}</span>
                                                    </h5>
                                                </div>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <p class="card-text">
                                            <h5 class="fs-14">Available: <span class="product-price"
                                                    id="available-product">{{ $product->quantity }}</span></h5>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            @if ($product->discount)
                                                <p class="card-text">
                                                <h5 class="fs-14 text-end">$<span class="product-price"
                                                        id="available-product">{{ $product->discount_price }}</span></h5>
                                                </p>
                                            @endif
                                        </div>
                                    </div>


                                    <form action="{{ route('admin.sellProduct') }}" method="post"
                                        onsubmit="return validateAndSubmit()">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <div class="col-7">
                                                <div class="input-step">
                                                    <button type="button" class="minus">–</button>
                                                    <input type="number" name="quantity" class="product-quantity"
                                                        value="1" min="1" max="{{ $product->quantity }}">
                                                    <button type="button" class="plus">+</button>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="text-end">
                                                    @if ($product->quantity > 0)
                                                        <button type="submit" class="btn btn-primary">Sell</button>
                                                    @else
                                                        <button class="btn btn-warning" disabled>Not Available</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- end card -->
                        </div><!-- end col -->
                    @endforeach
                    @if ($products->isEmpty())
                        <div class="noresult" style="display: block">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                    colors="primary:#25a0e2,secondary:#0ab39c" style="width:75px;height:75px">
                                </lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted">Add some products </p>
                            </div>
                        </div>
                    @endif
                </div><!-- end row -->




            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        @include('admin.components.footer')
    </div>
    <!-- end main content-->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function validateAndSubmit() {
            var availableProduct = parseInt(document.getElementById('available-product').innerText);
            var selectedQuantity = parseInt(document.querySelector('.product-quantity').value);

            if (selectedQuantity > availableProduct) {
                alert('Quantity exceeds available stock. Please select a lower quantity.');
                return false;
            } else {
                return true;
            }
        }

        $(document).ready(function() {
            $('.plus').on('click', function() {
                var input = $(this).siblings('.product-quantity');
                var max = parseInt($('#available-product').text());

                if (parseInt(input.val()) < max) {
                    input.val(parseInt(input.val()) + 1);
                }
            });

            $('.minus').on('click', function() {
                var input = $(this).siblings('.product-quantity');
                var min = parseInt(input.attr('min'));

                if (parseInt(input.val()) > min) {
                    input.val(parseInt(input.val()) - 1);
                }
            });
        });
    </script>
@endsection
