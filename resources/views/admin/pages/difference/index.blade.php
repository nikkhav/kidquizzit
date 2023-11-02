@extends('admin.layouts.main')
@section('heading_title', 'Find the difference')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Find the difference</h4>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'difference',
                        '__datatableId' => 'difference',
                    ])
                </div>
            </div>
            @include('admin.pages.difference.modal')
        </div>
    @endsection
    @push('js_stack')
        @include('admin.pages.difference.script')
    @endpush
