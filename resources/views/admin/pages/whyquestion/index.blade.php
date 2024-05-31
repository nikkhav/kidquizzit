@extends('admin.layouts.main')
@section('heading_title', 'Why Questions')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="my-3">
                <a href="/themes/whyquestion" class="btn btn-primary">
                    View current available themes for why questions
                </a>
                <a href="/themes/whyquestion/completed" class="btn btn-primary">
                    View completed themes for why questions
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Why Questions</h4>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'WhyQuestion',
                        '__datatableId' => 'whyQuestion',
                    ])
                </div>
            </div>
            @include('admin.pages.whyquestion.modal')
        </div>
    @endsection
    @push('js_stack')
        @include('admin.pages.whyquestion.script')
    @endpush

