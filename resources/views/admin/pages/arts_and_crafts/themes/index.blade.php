@extends('admin.layouts.main')
@section('heading_title', 'Themes for Arts and Crafts')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Import Arts and Crafts themes from CSV</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('arts_and_crafts.importCsv') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="csv_file" class="form-label">CSV File</label>
                            <input type="file" class="form-control" id="csv_file" name="csv_file" required>
                        </div>
                        <button type="submit" class="btn btn-success">Import CSV</button>
                    </form>
                    <form class="mt-3" action="{{ route('arts_and_crafts.storeToJson') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option selected>Select Category</option>
                                @php
                                    use App\Models\Category;
                                    $categories = Category::where('parent_id', 58)->get();
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
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Themes for Arts and Crafts</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Themes</th>
                            <th>Category</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(is_array($arts_and_crafts ?? []) && count($arts_and_crafts ?? []))
                            @foreach($arts_and_crafts ?? [] as $item)
                                <tr>
                                    <td>{!! $item['themes'] !!}</td>
                                    <td>{{ $item['category_name'] }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2">No Themes available.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
