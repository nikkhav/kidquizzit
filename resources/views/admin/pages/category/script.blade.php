<script>
    $(document).ready(function() {
        $('.create').click(function(e) {
            e.preventDefault();
            pageLoader(true);

            // Make an AJAX GET request to fetch the modal content
            $.ajax({
                type: "GET",
                url: "{{ route('category.create') }}",
                dataType: "json",
                success: function(response) {
                    if (response.code == 200) {
                        // Assuming response.view contains the HTML for the modal body
                        $("#create-modal .modal-body").html(response.view);
                        $("#create-modal").modal('show');
                    } else {
                        // Handle error case if needed
                        console.error('Failed to create category');
                    }
                    pageLoader(false);
                },
                error: function(error) {
                    // Handle AJAX request failure if needed
                    console.error('Failed to create category');
                    pageLoader(false);
                }
            });
        });

        $("#save-category").click(function(e) {
            e.preventDefault();
            pageLoader(true);
            let data = $("#create-form").serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('category.store') }}",
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.code == 200) {
                        dTReload();
                        $("#create-form").trigger("reset");
                        $("#create-modal").modal('toggle');
                    }
                    pageLoader(false);
                },
                error: function(error) {
                    if (error.status === 422) {
                        // Handle validation errors and populate input fields
                        $.each(error.responseJSON.errors, function(field, messages) {
                            $("#" + field).addClass('is-invalid');
                            $("#" + field + "-error").text(messages[0]);
                        });
                    } else {
                        // Handle other types of errors, e.g., server error
                        toastr.error("An error occurred while processing your request.");
                    }
                    pageLoader(false);
                }
            });
        });
        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('category.edit', 'edit') }}";
            url = url.replace('edit', id);
            let data = {
                _token: "{{ csrf_token() }}",
                id: id
            };
            pageLoader(true);
            $.get(url, function(response) {
                if (response.code == 200) {
                    $("#inputs").html(response.view);
                    $("#category-modal-edit").modal('toggle');
                }
                pageLoader(false);
            });
        });
        $("#edit-category").click(function(e) {
            e.preventDefault();
            pageLoader(true);

            let id = $("#edit-id").val();
            let title = $("#edit-title").val();
            let parent_id = $("#edit-parent_id").val();

            $.ajax({
                type: "PUT",
                url: "{{ route('category.update', 'update') }}".replace('update', id),
                data: {
                    id: id,
                    title: title,
                    parent_id: parent_id,
                    _token: '{{ csrf_token() }}', // Add CSRF token for security
                },
                dataType: "json",
                success: function(response) {
                    if (response.code == 200) {
                        dTReload();
                        $("#category-modal-edit").modal('toggle');
                    }
                    pageLoader(false);
                },
                error: function(error) {
                    $.each(error.responseJSON.errors, function(field, messages) {
                        $("#" + field + '-edit').addClass('is-invalid');
                        $("#" + field + "-error-edit").text(messages[0]);
                    });
                    pageLoader(false);
                }
            });
        });
    });
</script>
