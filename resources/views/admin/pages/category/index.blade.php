@extends('admin.layouts.main')
@section('heading_title', 'Category')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Categories</h4>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'category',
                        '__datatableId' => 'category',
                    ])
                </div>
            </div>
            @include('admin.pages.category.modal')
        </div>
    @endsection
    @push('js_stack')
        <script>
            $(document).ready(function() {

                $('.create').click(function(e) {
                    e.preventDefault();
                    pageLoader(true);
                    // Make an AJAX POST request to the controller
                    $.post("{{ route('category.create') }}", {
                        _token: "{{ csrf_token() }}"
                    }, function(response) {
                        if (response.code == 200) {
                            // Assuming response.view contains the HTML for the modal body
                            $("#create-modal .modal-body").html(response.view);
                            $("#create-modal").modal('show');
                        } else {
                            // Handle error case if needed
                            console.error('Failed to create category');
                        }
                        pageLoader(false);
                    }).fail(function(error) {
                        // Handle AJAX request failure if needed
                        console.error('Failed to create category');
                        pageLoader(false);
                    });
                });

                $("#save-category").click(function(e) {
                    e.preventDefault();
                    pageLoader(true);
                    let data = $("#create-form").serialize();
                    $.post("{{ route('category.store') }}", data,
                        function(response) {
                            if (response.code == 200) {
                                dTReload();
                                $("#create-form").trigger("reset");
                                $("#create-modal").modal('toggle');
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
                    let url = "{{ route('category.edit', 'edit') }}"
                    url = url.replace('edit', id);
                    let data = {
                        _token: "{{ csrf_token() }}",
                        id: id
                    };
                    pageLoader(true);
                    $.get(url, function(response) {
                        if (response.code == 200) {

                            $("#inputs").html(response.view);
                            $("#customer-type-modal-edit").modal('toggle');
                        }
                        pageLoader(false);
                    });
                });

                $("#edit-customer-type").click(function() {
                    let data = $("#edit-form").serialize();
                    let id = $("#edit-id").val();
                    let url = "{{ route('category.update', 'update') }}"
                    url = url.replace('update', id);

                    pageLoader(true);
                    $.post(url, data,
                        function(response) {
                            if (response.code == 200) {
                                dTReload();
                                // $("#create-form").trigger("reset");
                                $("#customer-type-modal-edit").modal('toggle');
                            }
                            pageLoader(false);
                        });
                })





            });
        </script>
    @endpush
