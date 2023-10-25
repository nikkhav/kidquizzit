@extends('admin.layouts.main')
@section('content')
    <!-- start page title -->
    <div class="row mb-3 pb-1">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-16 mb-1">Hello, @if (Auth::user()->gender == 1)
                            Mr.
                        @else
                            Mrs.
                        @endif{{ Auth::user()->name }} </h4>
                    <p class="text-muted mb-0">Create children's entertainment content with Kidquizzit Admin Panel</p>
                </div>
                <div class="mt-3 mt-lg-0">
                    <form action="javascript:void(0);">
                        <div class="row g-3 mb-0 align-items-center">
                            <div class="col-sm-auto">
                                <div class="input-group">
                                    <input type="text"
                                        class="w-160 form-control input-color-date border-0 date-picker form-control shadow"
                                        readonly="readonly">
                                    <div class="input-group-text bg-primary border-primary text-white ">
                                        <i class="ri-calendar-2-line"></i>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div><!-- end card header -->
        </div>
        <!--end col-->
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xxl-12">
            <div class="d-flex flex-column h-100">
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium font-size-department text-muted mb-0">Quizes</p>
                                        <h2 class="mt-3 mb-0 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $counts['quiz_count'] }}">0</span></h2>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('quiz.index') }}" class="text-decoration-un">All quizes</a>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info border-icon-department fs-2">
                                            <i data-feather="external-link" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                    <div class="col-md-6 col-xl-3">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium font-size-department text-muted mb-0">Colourings</p>
                                        <h2 class="mt-3 mb-0 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $counts['colouring_count'] }}">0</span></h2>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('colouring.index') }}" class="text-decoration-un">All Colourings</a>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info border-icon-department fs-2">
                                            <i data-feather="external-link" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                    <div class="col-md-6 col-xl-3">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium font-size-department text-muted mb-0">Find the difference</p>
                                        <h2 class="mt-3 mb-0 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $counts['difference_count'] }}">0</span></h2>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('difference.index') }}" class="text-decoration-un">All Find the
                                        difference</a>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info border-icon-department fs-2">
                                            <i data-feather="external-link" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                    <div class="col-md-6 col-xl-3">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium font-size-department text-muted mb-0">Why questions</p>
                                        <h2 class="mt-3 mb-0 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $counts['whyquestion_count'] }}">0</span></h2>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('whyquestion.index') }}" class="text-decoration-un">All Why
                                        questions</a>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info border-icon-department fs-2">
                                            <i data-feather="external-link" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </div>
        </div> <!-- end col-->
    </div> <!-- end row-->
@endsection
