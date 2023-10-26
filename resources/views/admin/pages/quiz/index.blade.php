@extends('admin.layouts.main')
@section('heading_title', 'Quiz')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quizzes</h4>
                </div>
                <div class="card-body">
                    @include('admin.inc.dynamic_datatable', [
                        '__datatableName' => 'quiz',
                        '__datatableId' => 'quiz',
                    ])
                </div>
            </div>
            @include('admin.pages.quiz.modal')
        </div>
    @endsection
    @push('js_stack')
        <script>
            $(document).ready(function() {

                $('.create').click(function(e) {
                    e.preventDefault();
                    pageLoader(true);
                    // Make an AJAX POST request to the controller
                    $.post("{{ route('quiz.create') }}", {
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

                    let formData = new FormData($("#create-form")[0]);

                    $.ajax({
                        url: "{{ route('quiz.store') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.code == 200) {
                                dTReload();
                                $("#create-form").trigger("reset");
                                $("#create-modal").modal('toggle');
                            }
                            pageLoader(false);
                        },
                        error: function(error) {
                            $.each(error.responseJSON, function(index, value) {
                                toastr.error(value);
                                pageLoader(false);
                            });
                        }
                    });
                });


                $(document).on('click', '.edit', function() {
                    let id = $(this).data('id');
                    let url = "{{ route('quiz.edit', 'edit') }}"
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
                    let formData = new FormData($("#edit-form")[0]); // Create FormData object from the form
                    let id = $("#edit-id").val();
                    let url = "{{ route('quiz.update', 'update') }}"
                    url = url.replace('update', id);

                    pageLoader(true);

                    // Use AJAX to submit form data including files
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false, // Prevent jQuery from processing the data
                        contentType: false, // Prevent jQuery from setting content type
                        success: function(response) {
                            if (response.code == 200) {
                                dTReload();
                                $("#customer-type-modal-edit").modal('toggle');
                            }
                            pageLoader(false);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText); // Log any errors for debugging
                            pageLoader(false);
                        }
                    });
                });

                $(document).on('click', '.view-questions', function() {
                    var quizId = $(this).data('id');
                    var url =
                        "{{ route('quizquestion.index', ['quizquestion' => 'quizquestion_id_placeholder']) }}";
                    url = url.replace('quizquestion_id_placeholder', quizId);
                    window.location.href = url;
                });
            });
        </script>
    @endpush
