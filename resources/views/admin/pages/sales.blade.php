@extends('admin.layouts.app')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Sales</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="card" id="orderList">

                            <div class="card-body pt-0">
                                <div>
                                    <ul class="nav nav-tabs nav-tabs-custom nav-primary mb-3" role="tablist">
                                        <li class="nav-item">
                                            <p class="nav-link active All py-3" data-bs-toggle="tab" id="All"
                                                role="tab" aria-selected="true">
                                                <i class="ri-store-2-fill me-1 align-bottom"></i> All Sales
                                            </p>
                                        </li>

                                    </ul>

                                    <div class="table-responsive table-card mb-1">
                                        <table class="table table-nowrap align-middle" id="orderTable">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">

                                                    <th class="text-center">Sales ID</th>
                                                    <th class="">Product</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Unit Price</th>
                                                    {{-- <th class="text-center">Discount</th>
                                                    <th class="text-center">Discount Price</th> --}}
                                                    <th class="text-center">Payable</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($sales as $sale)
                                                    <tr>

                                                        <td class="id text-center">
                                                            <p class="fw-medium link-primary">#<span
                                                                    id="product-id">{{ $sale->id }}</span></p>
                                                        </td>
                                                        <td class="product ">
                                                            <span>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-shrink-0 me-3">
                                                                        <div class="avatar-sm bg-light rounded p-1"><img
                                                                                src="{{ asset($sale->product_image) }}"
                                                                                alt="" class="img-fluid d-block">
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <h5 class="fs-14 mb-1" id="product-name">
                                                                            {{ $sale->product_name }}</h5>

                                                                    </div>
                                                                </div>
                                                            </span>
                                                        </td>

                                                        <td class="stock text-center" id="product-qty">
                                                            {{ $sale->sale_quantity }}</td>
                                                        <td class="unit-price text-center" id="product-unit-price">
                                                            ${{ $sale->price }}
                                                        </td>
                                                        {{-- <td class="discount text-center" id="product-discount">
                                                            {{ $sale->discount ? 'True' : 'False' }}
                                                        </td>
                                                        <td class="discount-price text-center" id="product-discount-price">
                                                            ${{ $sale->discount_price ?? 0 }}
                                                        </td> --}}
                                                        <td class="price text-center" id="product-price">
                                                            ${{ $sale->payable_amount }}
                                                        </td>

                                                        <td class="status text-center"><span
                                                                class="badge bg-success-subtle text-success text-uppercase">Sold</span>
                                                        </td>
                                                        @php
                                                            $carbonDate = \Carbon\Carbon::parse($sale->created_at);
                                                            $date = $carbonDate->format('d M, Y');
                                                            $time = $carbonDate->format('h:i A');
                                                        @endphp
                                                        <td class="date text-center">{{ $date }}, <small
                                                                class="text-muted">{{ $time }}</small>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if ($sales->isEmpty())
                                            <div class="noresult" style="display: block">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                        colors="primary:#25a0e2,secondary:#0ab39c"
                                                        style="width:75px;height:75px">
                                                    </lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                    <p class="text-muted">We've searched in the database but did
                                                        not find any
                                                        orders for you search.</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
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

                                @include('admin.components.delete_modal')
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
