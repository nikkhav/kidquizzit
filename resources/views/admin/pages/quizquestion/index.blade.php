@extends('admin.layouts.main')
@section('heading_title', 'Quiz Question')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Quiz Questions</h4>
                    <a href="{{ url('quiz') }}" class='btn btn-success btn-sm' title='Quiz'>
                        <i class='fas fa-arrow-left'></i> Back to Quiz
                    </a>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'quizquestion',
                        '__datatableId' => 'quizquestion',
                        '__cusomParam' => $id,
                    ])
                </div>
            </div>
            @include('admin.pages.quizquestion.modal')
        </div>
    @endsection
    @push('js_stack')
        @include('admin.pages.quizquestion.script')
    @endpush
