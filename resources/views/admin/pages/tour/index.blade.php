@extends('admin.layouts.main')
@section('heading_title', 'Tours')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="my-3">
                <a href="/themes/tour" class="btn btn-primary">
                    View current available themes for tours
                </a>
                <a href="/themes/tour/completed" class="btn btn-primary">
                    View completed themes for tours
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Tours</h4>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'tour',
                        '__datatableId' => 'tour',
                    ])
                </div>
            </div>
            @include('admin.pages.tour.modal')
        </div>
@endsection
@push('js_stack')
    @include('admin.pages.tour.script')
@endpush
