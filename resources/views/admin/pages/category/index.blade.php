@extends('admin.layouts.main')
@section('heading_title', 'Category')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Categories</h4>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'category',
                        '__datatableId' => 'category',
                    ])
                </div>
            </div>
            @include('admin.pages.category.modal')
        </div>
    @endsection
    @push('js_stack')
        @include('admin.pages.category.script')
    @endpush
