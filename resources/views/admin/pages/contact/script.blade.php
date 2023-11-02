<script>
    $(document).ready(function() {
        $(document).on('click', '.show-details', function(e) {
            e.preventDefault();
            pageLoader(true);
            let id = $(this).data('id');
            let status = $(this).data('status') ? true : false;
            let url = "{{ route('contact.show', 'show') }}";
            url = url.replace('show', id);
            let data = {
                _token: "{{ csrf_token() }}",
                id: id
            };
            if (!status) {
                statusUrl = "{{ route('contact.status', 'status') }}";
                statusUrl = statusUrl.replace('status', id);
                $.ajax({
                    url: statusUrl,
                    method: 'PUT',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.code == 200) {
                            $("#show-modal .modal-body").html(response.view);
                            $("#show-modal").modal('show');
                        } else {
                            console.error("Error: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + error);
                    }
                });
            }
            $.ajax({
                url: url,
                method: 'GET',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.code == 200) {
                        $("#show-modal .modal-body").html(response.view);
                        $("#show-modal").modal('show');
                    } else {
                        console.error("Error: " + response.message);
                    }

                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + error);
                },
                complete: function() {
                    pageLoader(false);
                }
            });
        });
    });
</script>
