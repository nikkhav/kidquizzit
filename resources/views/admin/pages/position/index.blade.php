@extends('admin.layouts.main')
@section('heading_title', 'Vəzifələr')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Vəzifələr</h4>
                </div>
                <div class="card-body">
                
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'position',
                        '__datatableId' => 'position',
                    ])
                </div>
            </div>
            <!-- end col -->
            @include('admin.pages.position.modal')
        </div>
    @endsection



    @push('js_stack')
        <script>
            $(document).ready(function() {

                
                $('.create').click(function (e) { 
                    e.preventDefault();
                    $("#position-modal").modal('toggle');
                });

                $("#save-position").click(function(e) {
                    e.preventDefault();
                    pageLoader(true);
                    let data = {
                        _token: "{{ csrf_token() }}",
                        name: $("#name").val()
                    }
                    $.post("{{ route('position.store') }}", data,
                        function(response) {
                            if (response.code == 200) {
                                dTReload();
                                $("#create-form").trigger("reset");
                                $("#position-modal").modal('toggle');
                            }
                            pageLoader(false);
                        }).fail(function(error) {
                        $.each(error.responseJSON, function(index, value) {
                            toastr.error(value);
                            pageLoader(false);
                        });
                    });
                });

                $(document).on('click', '.edit', function() {
                    let id = $(this).data('id');
                    let url = "{{ route('position.edit', 'edit') }}"
                    url = url.replace('edit', id);
                    pageLoader(true);
                    let data = {
                        _token: "{{ csrf_token() }}",
                        id: id
                    };

                    $.get(url, function(response) {
                        if (response.code == 200) {
                            $("#edit-name").val(response.data.name);
                            $("#edit-id").val(response.data.id);
                            $("#position-modal-edit").modal('toggle');
                        }
                        pageLoader(false);
                    });
                });

                $("#edit-position").click(function() {
                    let data = $("#edit-form").serialize();
                    let id = $(this).data('edit-id');
                    let url = "{{ route('position.update', 'update') }}"
                    url = url.replace('update', id);
                    pageLoader(true);
                    $.post(url, data,
                        function(response) {
                            if (response.code == 200) {
                                dTReload();
                                $("#create-form").trigger("reset");
                                $("#position-modal-edit").modal('toggle');
                            }
                            pageLoader(false);
                        });
                })

            });
        </script>
    @endpush
