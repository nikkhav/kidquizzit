@extends('admin.layouts.main')
@section('heading_title', 'Arts and Crafts')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="my-3">
                <a href="/themes/arts_and_crafts" class="btn btn-primary">
                    View current available themes for Arts and Crafts
                </a>
                <a href="/themes/arts_and_crafts/completed" class="btn btn-primary">
                    View completed themes for Arts and Crafts
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Arts and Crafts</h4>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'arts_and_crafts',
                        '__datatableId' => 'arts_and_crafts',
                    ])
                </div>
            </div>
            @include('admin.pages.arts_and_crafts.modal')
        </div>
    </div>
@endsection
@push('js_stack')
    @include('admin.pages.arts_and_crafts.script')
@endpush
