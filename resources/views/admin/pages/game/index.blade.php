@extends('admin.layouts.main')
@section('heading_title', 'Games')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="my-3">
                <a href="/themes/game" class="btn btn-primary">
                    View current available themes for games
                </a>
                <a href="/themes/game/completed" class="btn btn-primary">
                    View completed themes for games
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Games</h4>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'game',
                        '__datatableId' => 'game',
                    ])
                </div>
            </div>
            @include('admin.pages.game.modal')
        </div>
    @endsection
    @push('js_stack')
        @include('admin.pages.game.script')
    @endpush
