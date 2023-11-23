@extends('admin.layouts.main')
@section('heading_title', 'Fairy Tales')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Fairy Tales</h4>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'tale',
                        '__datatableId' => 'tale',
                    ])
                </div>
            </div>
            @include('admin.pages.tale.modal')
        </div>
    @endsection
    @push('js_stack')
        @include('admin.pages.tale.script')
    @endpush
