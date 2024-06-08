@extends('admin.layouts.main')

@section('heading_title', 'Completed Themes for Tours')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Completed Themes for Tours</h4>
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
                        {{-- Assuming $tours is passed from the controller with necessary data --}}
                        @foreach($tours as $tour)
                            <tr>
                                <td>{{ $tour['title'] }}</td>
                                <td>{{ $tour['category_name'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
