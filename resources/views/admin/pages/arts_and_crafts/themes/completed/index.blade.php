@extends('admin.layouts.main')

@section('heading_title', 'Completed Themes for Arts and Crafts')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Completed Themes for Arts and Crafts</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($arts_and_crafts as $item)
                            <tr>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ $item['category_name'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
