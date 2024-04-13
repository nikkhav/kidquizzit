@extends('admin.layouts.main')
@section('heading_title', 'Why Questions')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Import Why Questions from CSV</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('whyquestion.importCsv') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="csv_file" class="form-label">CSV File</label>
                            <input type="file" class="form-control" id="csv_file" name="csv_file" required>
                        </div>
                        <button type="submit" class="btn btn-success">Import CSV</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Why Questions</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('whyquestion.storeToJson') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option selected>Select Category</option>
                                {{-- Dynamically populate categories --}}
                                @php
                                    use App\Models\Category; // Use your actual namespace and class
                                    $categories = Category::where('parent_id', 3)->get();
                                @endphp
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" class="form-control" id="question" name="question" placeholder="Enter question" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Question</button>
                    </form>

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
