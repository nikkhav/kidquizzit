@extends('admin.layouts.main')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Tooltips</h4>
                <div class="flex-shrink-0">

                </div>
            </div><!-- end card header -->

            <div class="card-body">
                <form action="{{ route('user.store') }}"  method="POST">
                    @csrf

                    @include('admin.pages.user.__form')
                    <div class="form-group mb-0 pt-3">
                        <div>
                            <button type="submit" class="btn btn-success waves-effect waves-light mr-1">Əlavə et et</button>
                            <button type="reset" class="btn btn-danger waves-effect">İmtina et</button>
                        </div>
                    </div>
                </form>
               
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    @endsection