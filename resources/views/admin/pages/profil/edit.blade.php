@extends('admin.layouts.main')
@section('content')
    <div class="row">

        <div class="col-lg-12">
            {{--
        {{ Breadcrumbs::render('user') }} --}}
        </div>
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
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Profile Details</div>
                    <div class="card-body">



                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Name</label>
                                <input class="form-control" name="name" value="{{ old('name', $item->name) }}"
                                    id="inputFirstName" readonly type="text" placeholder="Adınızı daxil edin" vrequired>
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Surname</label>
                                <input class="form-control" name="surname" value="{{ old('name', $item->surname) }}"
                                    id="inputLastName" readonly type="text" placeholder="Soyadlnlzı daxil edin" required>
                            </div>
                        </div>
                        <!-- Form Row        -->

                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input class="form-control" name="email" value="{{ old('name', $item->email) }}"
                                id="inputEmailAddress" type="email" readonly placeholder="Enter your email address"
                                required>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Add changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('js_stack')
        <script>
            $(document).ready(() => {
                $('.profile-img').change(function() {
                    const file = this.files[0];
                    console.log(file);
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            console.log(event.target.result);
                            $('#imgPreview').attr('src', event.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
    @endpush
