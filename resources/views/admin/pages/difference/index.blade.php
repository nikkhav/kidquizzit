@extends('admin.layouts.main')
@section('heading_title', 'Logic Puzzles')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="my-3">
                <a href="/themes/whyquestion" class="btn btn-primary">
                    View current available themes for logic puzzles
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Logic Puzzles</h4>
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
