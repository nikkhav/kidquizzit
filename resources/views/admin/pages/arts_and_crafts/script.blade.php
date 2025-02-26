<script>
    $(document).ready(function() {

        $('.create').click(function(e) {
            e.preventDefault();
            pageLoader(true);
            $.post("{{ route('arts_and_crafts.create') }}", {
                _token: "{{ csrf_token() }}"
            }, function(response) {
                if (response.code == 200) {
                    $("#create-modal .modal-body").html(response.view);
                    $("#create-modal").modal('show');
                } else {
                    console.error('Failed to create Arts and Crafts entry');
                }
                pageLoader(false);
            }).fail(function(error) {
                console.error('Failed to create Arts and Crafts entry');
                pageLoader(false);
            });
        });

        $("#save-arts_and_crafts").click(function(e) {
            e.preventDefault();
            pageLoader(true);
            let titleContent = CKEDITOR.instances.title.getData();
            let descriptionContent = CKEDITOR.instances.description.getData();
            let formData = new FormData($("#create-form")[0]);
            formData.append('title', titleContent);
            formData.append('description', descriptionContent);

            $.ajax({
                url: "{{ route('arts_and_crafts.store') }}",
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
            let url = "{{ route('arts_and_crafts.edit', 'edit') }}";
            url = url.replace('edit', id);
            pageLoader(true);
            $.get(url, function(response) {
                if (response.code == 200) {
                    $("#inputs").html(response.view);
                    $("#arts_and_crafts-modal-edit").modal('toggle');
                }
                pageLoader(false);
            });
        });

        $("#edit-arts_and_crafts").click(function(e) {
            e.preventDefault();
            pageLoader(true);
            let id = $("#edit-id").val();
            let url = "{{ route('arts_and_crafts.update', 'update') }}";
            url = url.replace('update', id);
            let titleContent = CKEDITOR.instances['edit-title'].getData();
            let descriptionContent = CKEDITOR.instances['edit-description'].getData();
            let formData = new FormData($("#edit-form")[0]);
            formData.append('title', titleContent);
            formData.append('description', descriptionContent);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == 200) {
                        dTReload();
                        $("#arts_and_crafts-modal-edit").modal('toggle');
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

    });
</script>
