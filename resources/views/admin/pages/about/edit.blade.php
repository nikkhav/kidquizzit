@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-3">
                <div class="card-header mb-3">About Details</div>
                <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="col-md-12 mb-3 d-flex justify-content-center">
                        <img class="mb-2" id="imgPreview" width="500px" src="{{ asset('storage/') . '/' . $item->image }}"
                            alt="">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="small mb-1" for="inputFirstName">Image</label>
                        <input type="file" name="image" class="form-control about-img">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="small mb-1" for="inputFirstName">Title</label>
                        <textarea class="form-control" name="title" 
                            id="inputFirstName" type="text" placeholder="Add title" required>{{ old('title', $item->title) }} </textarea>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="small mb-1" for="inputLastName">Subtitle</label>
                        <textarea class="form-control" name="subtitle" 
                            id="inputLastName" type="text" placeholder="Add Subtitle" required>{{ old('subtitle', $item->subtitle) }} </textarea>
                        @error('subtitle')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="small mb-1" for="inputDescription">Description</label>
                        <textarea class="form-control" style="resize: none;" name="description" id="inputDescription"
                            placeholder="Add Description" rows="15" required>{{ old('description', $item->description) }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input class="form-control" name="id" value="{{ old('id', $item->id) }}" type="hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('js_stack')
    @include('admin.pages.about.script')
@endpush
