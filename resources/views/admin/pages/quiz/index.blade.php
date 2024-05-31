@extends('admin.layouts.main')
@section('heading_title', 'Quiz')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="my-3">
                <a href="/themes/quiz" class="btn btn-primary">
                    View current available themes for quizzes
                </a>
                <a href="/themes/quiz/completed" class="btn btn-primary">
                    View completed themes for quizzes
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quizzes</h4>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'quiz',
                        '__datatableId' => 'quiz',
                    ])
                </div>
            </div>
            @include('admin.pages.quiz.modal')
        </div>
@endsection
@push('js_stack')
    @include('admin.pages.quiz.script')
@endpush
