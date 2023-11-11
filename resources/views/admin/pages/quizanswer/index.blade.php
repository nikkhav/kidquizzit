@extends('admin.layouts.main')
@section('heading_title', 'Quiz Question Answer')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Quiz Question Answers</h4>
                    <a class='btn btn-success btn-sm view-questions' title='Question' data-id="{{ $quizquestion->quiz_id }}">
                        <i class='fas fa-arrow-left'></i> Back to Questions
                    </a>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'QuizAnswer',
                        '__datatableId' => 'quizanswer',
                    ])
                </div>
            </div>
            @include('admin.pages.quizanswer.modal')
        </div>
    @endsection
    @push('js_stack')
        @include('admin.pages.quizanswer.script')
    @endpush
