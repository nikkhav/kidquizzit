@extends('admin.layouts.main')
@section('heading_title', 'Colouring')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Colourings</h4>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'colouring',
                        '__datatableId' => 'colouring',
                    ])
                </div>
            </div>
            @include('admin.pages.colouring.modal')
        </div>
    @endsection
    @push('js_stack')
        @include('admin.pages.colouring.script')
    @endpush
