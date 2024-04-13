@extends('admin.layouts.main')
@section('heading_title', 'Fairy Tales')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Import Tales themes from CSV</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tale.importCsv') }}" method="POST" enctype="multipart/form-data">
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
                    <h4 class="card-title mb-0">Fairy Tales</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tale.storeToJson') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option selected>Select Category</option>
                                {{-- Dynamically populate categories --}}
                                @php
                                    use App\Models\Category; // Use your actual namespace and class
                                    $categories = Category::where('parent_id', 40)->get();
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
