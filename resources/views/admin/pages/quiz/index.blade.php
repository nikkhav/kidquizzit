@extends('admin.layouts.main')
@section('heading_title', 'Quiz')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quizzes</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('quiz.storeToJson') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option selected>Select Category</option>
                                {{-- Dynamically populate categories --}}
                                @php
                                    use App\Models\Category; // Use your actual namespace and class
                                    $categories = Category::where('parent_id', 1)->get();
                                @endphp
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="theme" class="form-label">Theme</label>
                            <input type="text" class="form-control" id="theme" name="theme" placeholder="Enter theme" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Theme</button>
                    </form>
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
