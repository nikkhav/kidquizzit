<script>
    $(document).ready(function() {

        $('.create').click(function(e) {
            e.preventDefault();
            pageLoader(true);
            // Make an AJAX POST request to the controller
            $.post("{{ route('quizanswer.create') }}", {
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
                url: "{{ route('quizanswer.store') }}",
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
                    $.each(error.responseJSON.errors, function(field, messages) {
                        $("#" + field).addClass('is-invalid');
                        $("#" + field + "-error").text(messages[0]);
                    });
                    pageLoader(false);
                }
            });
        });


        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('quizanswer.edit', 'edit') }}"
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

        $("#edit-customer-type").click(function(e) {
            e.preventDefault();
            pageLoader(true);
            let formData = new FormData($("#edit-form")[0]); // Create FormData object from the form
            let id = $("#edit-id").val();
            let url = "{{ route('quizanswer.update', 'update') }}"
            url = url.replace('update', id);


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
                error: function(error) {
                    $.each(error.responseJSON.errors, function(field, messages) {
                        $("#edit-" + field).addClass('is-invalid');
                        $("#error-edit-" + field).text(messages[0]);
                    });
                    pageLoader(false);
                }
            });
        });

        $(document).on('click', '.view-questions', function() {
            var urlParams = new URLSearchParams(window.location.search);
            var quiz_id = urlParams.get('quiz_id');
            var url = "{{ route('quizquestion.show') }}";
            url = url + '?quiz_id=' + quiz_id;
            window.location.href = url;
        });

    });
</script>
