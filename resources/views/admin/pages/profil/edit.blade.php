@extends('admin.layouts.main')
@section('content')
    <div class="row">
        <div class="row">
            <div class="col-xl-4">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Photo</div>
                        <div class="card-body text-center">
                            <img class="img-account-profile rounded-circle mb-2 " id="imgPreview" width="300px"
                                src="{{ asset($item->image) }}" alt="">
                            <input type="file" name="image" class="form-control profile-img">
                        </div>
                    </div>
            </div>
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">Profile Details</div>
                    <div class="card-body">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Name</label>
                                <input class="form-control" name="name" value="{{ old('name', $item->name) }}"
                                    id="inputFirstName" type="text" placeholder="Enter your name" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Surname</label>
                                <input class="form-control" name="surname" value="{{ old('surname', $item->surname) }}"
                                    id="inputLastName" type="text" placeholder="Enter your Surname" required>
                                @error('surname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input class="form-control" name="email" value="{{ old('email', $item->email) }}"
                                id="inputEmailAddress" type="email" placeholder="Enter your email address" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Add changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('js_stack')
        @include('admin.pages.profil.script')
    @endpush
