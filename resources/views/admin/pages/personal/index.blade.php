@extends('admin.layouts.main')
@section('heading_title', 'Əməkdaşlar')

@section('heading_buttons')
    {{-- @can('personal.create')
        <button type="button" class="btn btn-primary  arrow-none waves-effect waves-light create">
            <i class="fas fa-plus mr-2"></i> Əlavə et
        </button>
    @endcan --}}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Əməkdaşlar</h4>
                </div>
                <div class="card-body">

                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'personal',
                        '__datatableId' => 'personal',
                    ])
                </div>
            </div>
            <!-- end col -->
            @include('admin.pages.personal.modal')
            {{-- @include('admin.pages.personal.edit-modal-render') --}}
        </div>
        {{-- @dd($roles) --}}
    @endsection



    @push('js_stack')
        <!-- form mask -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function() {
                $('.create').click(function(e) {
                    e.preventDefault();
                    $("#personal-modal").modal('toggle');
                });
                $("#save-personal").click(function(e) {
                    e.preventDefault();
                    pageLoader(true);
                    let data = new FormData($("#create-form").get(0));
                    $.ajax({
                        url: "{{ route('personal.store') }}",
                        type: 'POST',
                        data: data,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $("#create-form").trigger("reset");
                            $("#personal-modal").modal('toggle');
                            pageLoader(false);
                            dTReload();
                            console.log(response);
                        },
                        error: function(jqXHR) {
                            pageLoader(false);
                            console.log(jqXHR)
                            $.each(jqXHR.responseJSON, function(error, index) {
                                toastr.error(index);
                            })
                        }
                    });
                });

                $(document).on('click', '.edit', function() {
                    let id = $(this).data('id');
                    let url = "{{ route('personal.edit', 'edit') }}"
                    url = url.replace('edit', id);
                    let data = {
                        _token: "{{ csrf_token() }}",
                        id: id
                    };
                    pageLoader(true);
                    let modal = $("#personal-modal-edit");
                    $.get(url, function(response) {
                        $('#edit-form').trigger("reset");
                        if (response.code == 200) {
                            modal.find("#name").val(response.data.name);
                            modal.find("#surname").val(response.data.surname);
                            modal.find("#gender").val(response.data.gender);
                            modal.find("#email").val(response.data.email);
                            modal.find("#phone").val(response.data.phone);
                            modal.find("#address").val(response.data.address);
                            modal.find("#info").val(response.data.info);
                            modal.find("#department_id").val(response.data.department_id);
                            modal.find("#role_id").val(response.data.role_id);
                            modal.find("#position_id").val(response.data.position_id);
                            modal.find('#edit-id').val(response.data.id);
                            modal.find("#edit-profil-fotografi-goster").attr('src', response.data.image);
                            // var predefinedDate = new Date(2023, 3, 30);
                            var myFlatpickr = flatpickr(".birthday", {
                                dateFormat: "m/d/Y",
                               
                            });
                            // set the date to May 1, 2023
                            myFlatpickr.setDate(response.data.birthday, true, "m/d/Y");

                            $(modal).modal('toggle');
                        }
                        pageLoader(false);

                    });
                });

                $("body").on('click', "#edit-position", function() {

                    // var data = new FormData(document.getElementById("edit-form"));
                    let data = new FormData($("#edit-form").get(0));
                    let id = $(document).find('#edit-id').val();
                    let url = "{{ route('personal.alter', 'edit-id') }}";
                    url = url.replace('edit-id', id);

                    pageLoader(true);
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            pageLoader(false);
                            $("#personal-modal-edit").modal('toggle');
                            dTReload();
                            console.log(response);
                        },
                        error: function(jqXHR) {
                            pageLoader(false);
                            console.log(jqXHR)
                            $.each(jqXHR.responseJSON, function(error, index) {
                                toastr.error(index);
                            })
                        }
                    });

                })
            });
        </script>
    @endpush
