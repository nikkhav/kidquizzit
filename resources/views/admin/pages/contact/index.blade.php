@extends('admin.layouts.main')
@section('heading_title', 'Contact Us')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Contact Us</h4>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'contact',
                        '__datatableId' => 'contact',
                    ])
                </div>
            </div>
            @include('admin.pages.contact.show')
        </div>
    @endsection
    @push('js_stack')
        @include('admin.pages.contact.script')
    @endpush
