@extends('admin.layouts.main')

@section('heading_title', 'Roles')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Rollar</h4>
                    </div>
                <div class="card-body">
                    {{-- <h4 class="mt-0 header-title"></h4> --}}
                    {{-- <h5 class="card-title">Role List</h5> --}}
                    <table id="datatable-buttons" class="table table-striped table-bordered"  style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Ad</th>
                            <th>İcazə sayı</th>
                            <th>Yaradılma tarixi</th>
                            <th>Əməliyyat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->permissions_count }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ route('role.edit', $item) }}" class="btn btn-sm btn-secondary">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection

@push('css_stack')
    <!-- DataTables -->
    <link href="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endpush


@push('js_stack')
    <!-- Required datatable js -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('admin/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('admin/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $("#datatable-buttons").DataTable({
                dom: 'fBtip',
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/az.tr.json"
                    },
                    lengthChange: true,
                    language: { search: "" , searchPlaceholder: "Axtar..." },
                    "lengthMenu": [ [10, 25, 50, 100, 300,'-1'], ['10 Ədəd', '25 Ədəd', '50 Ədəd', '100 Ədəd', '300 Ədəd', 'Hamısı'] ],
                    @can('role.create')
                    buttons: [{
                        text: '<i class="fas fa-plus"></i> Əlavə et',
                        className: 'btn btn-primary  arrow-none waves-effect waves-light create',
                            action: function ( e) {
                                window.location = "{{ route('role.create') }}"; 
                            }
                        },
                    @endcan
                        // {
                        //     extend: 'csv',
                        //     text: '<i class="fas fa-file-csv fa-1x"></i> CSV'
                        // },
                        // {
                        //     extend: 'excel',
                        //     text: '<i class="fas fa-file-excel" aria-hidden="true"></i> EXCEL'
                        // },
                    
                    ],        lengthChange: true,
                    // buttons: ["copy","excel","pdf","colvis"]
            }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
        });
    </script>
@endpush
