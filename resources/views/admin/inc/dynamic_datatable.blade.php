<div class="table-responsive">
    <table id="{{ $__datatableId }}" class="table table-striped table-bordered"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    </table>
</div>

@push('js_stack')
    @php
        if (isset($__export)) {
            $__excel = isset($__export['excel']) ? $__export['excel'] : '1,2,3,4';
            $__pdf = isset($__export['pdf']) ? $__export['pdf'] : '1,2,3,4';
            $__print = isset($__export['print']) ? $__export['print'] : '1,2,3,4';
        } else {
            $__excel = '0,1,2,3,4,5,6,7,8,9,10';
            $__pdf = '0,1,2,3,4,5,6,7,8,9,10';
            $__print = '0,1,2,3,4,5,6,7,8,9,10';
        }

        $__cusomParam = isset($__cusomParam) && is_array($__cusomParam) ? ($__cusomParam = http_build_query($__cusomParam, '', '&amp;')) : '';

    @endphp
    <script>
        $(document).ready(function() {
            axiosInstance
                .get('{{ route('datatable.source', $__datatableName) }}?show_columns=ok')
                .then(result => {
                    initTable(result.data);
                })
                .catch(error => {
                    console.log(error);
                    basicAlert('error on request')
                });

            function initTable(_columns) {
                window.dTable = $("#{{ isset($__datatableId) ? $__datatableId : 'datatable' }}").DataTable({
                    dom: 'fBtip',
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/az.tr.json"
                    },
                    lengthChange: true,
                    language: {
                        search: "",
                        searchPlaceholder: "Find..."
                    },
                    "lengthMenu": [
                        [10, 25, 50, 100, 300, '-1'],
                        ['10 pcs', '25 pcs', '50 pcs', '100 pcs', '300 Ədəd', 'All']
                    ],
                    buttons: [
                        @if (Request::segment(1) !== 'contact')
                            {
                                text: '<i class="fas fa-plus"></i> Add',
                                className: 'btn btn-primary  arrow-none waves-effect waves-light create',
                                action: function(e) {
                                    $(".create-modal").modal('toggle');
                                }
                            }
                        @endif
                    ],
                    "ajax": {
                        url: "{{ route('datatable.source', $__datatableName) . '?' . $__cusomParam }}",
                        type: "GET",
                        data: get_query()
                    },
                    columns: _columns.map(function(column) {
                        if (column.data === 'image') {
                            return {
                                data: 'image',
                                title: 'Image',
                                render: function(data, type, row) {
                                    if (type === 'display' && data) {
                                        return '<img src="storage/' + data +
                                            '" alt="Image" class="img-thumbnail" style="max-width: 100px; max-height: 200px;">';
                                    }
                                    return data;
                                }
                            };
                        }
                        if (column.data === 'image1') {
                            return {
                                data: 'image1',
                                title: 'Image1',

                                render: function(data, type, row) {
                                    if (type === 'display' && data) {
                                        return '<img src="storage/' + data +
                                            '" alt="Image" class="img-thumbnail" style="max-width: 100px; max-height: 200px;">';
                                    }
                                    return data;
                                }
                            };
                        }
                        if (column.data === 'image2') {
                            return {
                                data: 'image2',
                                title: 'Image2',

                                render: function(data, type, row) {
                                    if (type === 'display' && data) {
                                        return '<img src="storage/' + data +
                                            '" alt="Image" class="img-thumbnail" style="max-width: 100px; max-height: 200px;">';
                                    }
                                    return data;
                                }
                            };
                        }
                        return column;
                    }),
                    serverSide: true,
                    responsive: false,
                    lengthChange: true,
                    processing: true,
                    order: [
                        [0, 'desc']
                    ],
                    "columnDefs": [{
                            "className": "dt-center",
                            "targets": "_all"
                        },
                        {
                            orderable: false,
                            targets: [0]
                        },
                        {
                            targets: 'no-sort',
                            orderable: false
                        }
                    ],
                    "fnPreDrawCallback": function() {
                        $('#dataTables_processing').attr('style',
                            'font-size: 20px; font-weight: bold; padding-bottom: 60px; display: block; z-index: 10000 !important'
                        );
                    }
                });
                window.dTable.buttons().container().appendTo(
                    "#datatable-buttons_wrapper .col-md-6:eq(0)");
            }
        });
    </script>
@endpush
