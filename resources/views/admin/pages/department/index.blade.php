@extends('admin.layouts.main')
@section('heading_title', 'Departament')

@section('heading_buttons')
    {{-- @can('users.create')
        <button type="button"  class="btn btn-primary float-right arrow-none waves-effect waves-light create">
            <i class="fas fa-plus mr-2"></i> Əlavə et
        </button>
    @endcan --}}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
{{-- 
        {{ Breadcrumbs::render('user') }} --}}
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Departamentlər</h4>
            </div>
            <div class="card-body">
                
                @include('admin.inc.dynamic_datatable', [
                    '__datatableName' => 'departament',
                    '__datatableId' => 'departament',
                ])
            </div>
    </div>
    <!-- end col -->
    @include('admin.pages.department.modal')
</div>
@endsection



@push('js_stack')
    <script>
        $(document).ready(function () {

           
            $(".create").click(function (e) { 
                e.preventDefault();
             
                $("#derpartment-modal").modal('toggle');
            });
            $("#save-departament").click(function (e) { 
                e.preventDefault();
                let data = {
                    _token : "{{ csrf_token() }}",
                    name: $("#name").val()
                }
                pageLoader(true);                
                $.post("{{route('department.store')}}", data,
                    function (response) {
                     if(response.code == 200){
                        dTReload();
                        $("#create-form").trigger("reset");
                        $("#derpartment-modal").modal('toggle');
                     }
                     pageLoader(false);
                    }).fail(function(error) {
                       $.each(error.responseJSON, function (index, value) { 
                        toastr.error(value)
                       });
                       pageLoader(false);
                    });;
            });



            $(document).on('click','.edit',function(){
                let id = $(this).data('id');
                let url = "{{route('department.edit','edit')}}"
                url = url.replace('edit',id);

                let data = {
                    _token: "{{csrf_token()}}",
                    id: id
                };
                pageLoader(true);
                $.get(url, function (response) {
                    if(response.code == 200){
                        $("#edit-name").val(response.data.name);
                        $("#edit-id").val(response.data.id);
                        $("#derpartment-modal-edit").modal('toggle');
                    }
                    pageLoader(false);
                });
            });

        $("#edit-departament").click(function(){
            let data = $("#edit-form").serialize();
            let id = $(this).data('edit-id');
            let url = "{{route('department.update','update')}}"
            url = url.replace('update',id);
            pageLoader(true);
            $.post(url, data,
                function (response) {
                    if(response.code == 200){
                        dTReload();
                        $("#create-form").trigger("reset");
                        $("#derpartment-modal-edit").modal('toggle');
                    }
                    pageLoader(false);
                });
          
     
        })


        });

        
    </script>

@endpush
