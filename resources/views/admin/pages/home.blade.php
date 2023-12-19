@extends('admin.layouts.app')

@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <h4 class="fs-16 mb-1">Welcome, {{ Session::get('admin')['username'] }}!</h4>
                                            <p class="text-muted mb-0">
                                                Here's what's happening with your store.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- end card header -->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->

                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Total Revenue
                                                    </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-success fs-14 mb-0">
                                                        @if ($salesReport['today'] >= $salesReport['Yesterday'])
                                                            <i
                                                                class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                                        @else
                                                            <i
                                                                class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i>
                                                        @endif
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$
                                                        <span class="counter-value"
                                                            data-target="{{ $salesReport['today'] }}">0</span>
                                                    </h4>
                                                    <p class="text-muted mb-0">Today</p>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span
                                                        class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                        <i class="bx bxs-badge-dollar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Total Revenue
                                                    </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-success fs-14 mb-0">
                                                        @if ($salesReport['Yesterday'] > $salesReport['today'])
                                                            <i
                                                                class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                                        @else
                                                            <i
                                                                class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i>
                                                        @endif
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$
                                                        <span class="counter-value"
                                                            data-target="{{ $salesReport['Yesterday'] }}">0</span>
                                                    </h4>
                                                    <p class="text-muted mb-0">Yesterday</p>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span
                                                        class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                        <i class="bx bxs-badge-dollar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Total Revenue
                                                    </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-success fs-14 mb-0">
                                                        @if ($salesReport['thisMonth'] >= $salesReport['lastMonth'])
                                                            <i
                                                                class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                                        @else
                                                            <i
                                                                class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i>
                                                        @endif
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$
                                                        <span class="counter-value"
                                                            data-target="{{ $salesReport['thisMonth'] }}">0</span>
                                                    </h4>
                                                    <p class="text-muted mb-0">This Month</p>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span
                                                        class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                        <i class="bx bxs-badge-dollar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Total Revenue
                                                    </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-success fs-14 mb-0">
                                                        @if ($salesReport['lastMonth'] > $salesReport['thisMonth'])
                                                            <i
                                                                class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                                        @else
                                                            <i
                                                                class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i>
                                                        @endif
                                                    </h5>
                                                </div>

                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$
                                                        <span class="counter-value"
                                                            data-target="{{ $salesReport['lastMonth'] }}">0</span>
                                                    </h4>
                                                    <p class="text-muted mb-0">Last month</p>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span
                                                        class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                        <i class="bx bxs-badge-dollar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->

                            </div>
                            <!-- end row-->

                        </div>
                        <!-- end .h-100-->
                    </div>
                    <!-- end col -->

                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        @include('admin.components.footer')
    </div>
    <!-- end main content-->
@endsection
