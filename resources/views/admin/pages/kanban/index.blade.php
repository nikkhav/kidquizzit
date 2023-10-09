@extends('admin.layouts.main')
@section('content')

           <!-- start page title -->
           <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Kanban Board</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tasks</a></li>
                            <li class="breadcrumb-item active">Kanban Board</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

         {{-- <div class="card">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-lg-auto">
                        <div class="hstack gap-2">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createboardModal"><i class="ri-add-line align-bottom me-1"></i> Create Board</button>
                        </div>
                        <div class="hstack gap-2">
                            <button class="btn btn-primary" data-bs-toggle="modal" onclick="update()"><i class="ri-add-line align-bottom me-1"></i> update</button>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-3 col-auto">
                        <div class="search-box">
                            <input type="text" class="form-control search" id="search-task-options" placeholder="Search for project, tasks...">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <div class="col-auto ms-sm-auto">
                        <div class="avatar-group" id="newMembar">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy">
                                <img src="{{asset('admin/assets/images/users/avatar-5.jpg')}}" alt="" class="rounded-circle avatar-xs">
                            </a>
                     
                            <a href="#addmemberModal" data-bs-toggle="modal" class="avatar-group-item">
                                <div class="avatar-xs">
                                    <div class="avatar-title rounded-circle">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end card-body-->
        </div>  --}}
        <!--end card-->

        <div class="tasks-board mb-3" id="kanbanboard" style="padding-bottom: 20px">
            <input type="hidden" name="kanban update" id="kanpan_update" value="{{route('kanban.update')}}">
            @foreach ($statuses as $status)
            <div class="tasks-list border-end border-white border-3 p-1" data-status="{{$status->id}}">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <h6 class="fs-14 text-uppercase fw-semibold mb-0">{{$status->name}} <small class="badge align-bottom ms-1 totaltask-badge" style="background-color: {{$status->color}} !important">{{$status->tasks_count}}</small></h6>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-medium text-muted fs-12">Priority<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Priority</a>
                                <a class="dropdown-item" href="#">Date Added</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-simplebar class="tasks-wrapper px-3 mx-n3">
                    <div id="{{ $status->id}}-task" class="tasks task-list" >
                        @foreach ($status->tasks as $task)
                        <div class="card tasks-box" data-task="{{$task->id }}" >

                            <div class="card-body" >
                                <div class="d-flex mb-2">
                                     <h6 class="fs-15 mb-0 flex-grow-1 text-truncate task-title"><a href="{{route('task.details',$task->id)}}" class="d-block">{{$task->title}}</a></h6>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <li><a class="dropdown-item" href="{{route('task.details',$task->id)}}"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="text-muted">{{Str::limit($task->description, 50)}}</p>
                                <div class="mb-3">
                                    <div class="d-flex mb-1">
                                        {{-- <div class="flex-grow-1">
                                            <h6 class="text-muted mb-0"><span class="text-secondary">15%</span> of 100%</h6>
                                        </div> --}}
                                        <div class="flex-shrink-0">
                                            <span class="text-muted">{{$task->created_at}}</span>
                                        </div>
                                    </div>
                                    <div class="progress rounded-3 progress-sm">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="badge badge-soft-primary">{{$task->priority}}</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="avatar-group">
                                            @foreach ($task->user as $user)
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{$user->name}}">
                                                <img src="{{asset('admin/assets/images/users/avatar-3.jpg')}}" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-top-dashed">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h6 class="text-muted mb-0">#{{$task->id}}</h6>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <ul class="link-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-eye-line align-bottom"></i> 04</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-question-answer-line align-bottom"></i> 19</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-attachment-2 align-bottom"></i> 02</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                            
                        </div>
                        @endforeach
                    </div>
                    <!--end tasks-->
                </div>
                {{-- <div class="my-3">
                    <button class="btn btn-soft-info w-100" data-bs-toggle="modal" data-bs-target="#creatertaskModal">Add More</button>
                </div> --}}
            </div>
            <!--end tasks-list-->
            @endforeach
        </div>
        <!--end task-board-->

     <div class="modal fade" id="addmemberModal" tabindex="-1" aria-labelledby="addmemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-soft-warning">
                    <h5 class="modal-title" id="addmemberModalLabel">Add Member</h5>
                    <button type="button" class="btn-close" id="btn-close-member" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label for="submissionidInput" class="form-label">Submission ID</label>
                                <input type="number" class="form-control" id="submissionidInput" placeholder="Submission ID">
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="profileimgInput" class="form-label">Profile Images</label>
                                <input class="form-control" type="file" id="profileimgInput">
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="firstnameInput" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstnameInput" placeholder="Enter firstname">
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="lastnameInput" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastnameInput" placeholder="Enter lastname">
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="designationInput" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="designationInput" placeholder="Designation">
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="titleInput" class="form-label">Title</label>
                                <input type="text" class="form-control" id="titleInput" placeholder="Title">
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="numberInput" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="numberInput" placeholder="Phone number">
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="joiningdateInput" class="form-label">Joining Date</label>
                                <input type="text" class="form-control" id="joiningdateInput" data-provider="flatpickr" placeholder="Select date">
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="emailInput" class="form-label">Email ID</label>
                                <input type="email" class="form-control" id="emailInput" placeholder="Email">
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><i class="ri-close-line align-bottom me-1"></i> Close</button>
                    <button type="button" class="btn btn-success" id="addMember">Add Member</button>
                </div>
            </div>
        </div>
    </div> 
    <!--end add member modal-->

    <div class="modal fade" id="createboardModal" tabindex="-1" aria-labelledby="createboardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-soft-info">
                    <h5 class="modal-title" id="createboardModalLabel">Add Board</h5>
                    <button type="button" class="btn-close" id="addBoardBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="boardName" class="form-label">Board Name</label>
                                <input type="text" class="form-control" id="boardName" placeholder="Enter board name">
                            </div>
                            <div class="mt-4">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success" id="addNewBoard">Add Board</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    <!--end add board modal-->

    <div class="modal fade" id="creatertaskModal" tabindex="-1" aria-labelledby="creatertaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-soft-info">
                    <h5 class="modal-title" id="creatertaskModalLabel">Create New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label for="projectName" class="form-label">Project Name</label>
                                <input type="text" class="form-control" id="projectName" placeholder="Enter project name">
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="sub-tasks" class="form-label">Task Title</label>
                                <input type="text" class="form-control" id="sub-tasks" placeholder="Task title">
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="task-description" class="form-label">Task Description</label>
                                <textarea class="form-control" id="task-description" rows="3" placeholder="Task description"></textarea>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="formFile" class="form-label">Tasks Images</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="tasks-progress" class="form-label">Add Team Member</label>
                                <div data-simplebar style="height: 95px;">
                                    <ul class="list-unstyled vstack gap-2 mb-0">
                                        <li>
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input me-3" type="checkbox" value="" id="anna-adame">
                                                <label class="form-check-label d-flex align-items-center" for="anna-adame">
                                                    <span class="flex-shrink-0">
                                                        <img src="{{asset('admin/assets/images/users/avatar-1.jpg')}}" alt="" class="avatar-xxs rounded-circle" />
                                                    </span>
                                                    <span class="flex-grow-1 ms-2">
                                                        Anna Adame
                                                    </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input me-3" type="checkbox" value="" id="frank-hook">
                                                <label class="form-check-label d-flex align-items-center" for="frank-hook">
                                                    <span class="flex-shrink-0">
                                                        <img src="{{asset('admin/assets/images/users/avatar-3.jpg')}}" alt="" class="avatar-xxs rounded-circle" />
                                                    </span>
                                                    <span class="flex-grow-1 ms-2">
                                                        Frank Hook
                                                    </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input me-3" type="checkbox" value="" id="alexis-clarke">
                                                <label class="form-check-label d-flex align-items-center" for="alexis-clarke">
                                                    <span class="flex-shrink-0">
                                                        <img src="{{asset('admin/assets/images/users/avatar-6.jpg')}}" alt="" class="avatar-xxs rounded-circle" />
                                                    </span>
                                                    <span class="flex-grow-1 ms-2">
                                                        Alexis Clarke
                                                    </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input me-3" type="checkbox" value="" id="herbert-stokes">
                                                <label class="form-check-label d-flex align-items-center" for="herbert-stokes">
                                                    <span class="flex-shrink-0">
                                                        <img src="{{asset('admin/assets/images/users/avatar-2.jpg')}}" alt="" class="avatar-xxs rounded-circle" />
                                                    </span>
                                                    <span class="flex-grow-1 ms-2">
                                                        Herbert Stokes
                                                    </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input me-3" type="checkbox" value="" id="michael-morris">
                                                <label class="form-check-label d-flex align-items-center" for="michael-morris">
                                                    <span class="flex-shrink-0">
                                                        <img src="{{asset('admin/assets/images/users/avatar-7.jpg')}}" alt="" class="avatar-xxs rounded-circle" />
                                                    </span>
                                                    <span class="flex-grow-1 ms-2">
                                                        Michael Morris
                                                    </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input me-3" type="checkbox" value="" id="nancy-martino">
                                                <label class="form-check-label d-flex align-items-center" for="nancy-martino">
                                                    <span class="flex-shrink-0">
                                                        <img src="{{asset('admin/assets/images/users/avatar-5.jpg')}}" alt="" class="avatar-xxs rounded-circle" />
                                                    </span>
                                                    <span class="flex-grow-1 ms-2">
                                                        Nancy Martino
                                                    </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input me-3" type="checkbox" value="" id="thomas-taylor">
                                                <label class="form-check-label d-flex align-items-center" for="thomas-taylor">
                                                    <span class="flex-shrink-0">
                                                        <img src="{{asset('admin/assets/images/users/avatar-8.jpg')}}" alt="" class="avatar-xxs rounded-circle" />
                                                    </span>
                                                    <span class="flex-grow-1 ms-2">
                                                        Thomas Taylor
                                                    </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input me-3" type="checkbox" value="" id="tonya-noble">
                                                <label class="form-check-label d-flex align-items-center" for="tonya-noble">
                                                    <span class="flex-shrink-0">
                                                        <img src="{{asset('admin/assets/images/users/avatar-10.jpg')}}" alt="" class="avatar-xxs rounded-circle" />
                                                    </span>
                                                    <span class="flex-grow-1 ms-2">
                                                        Tonya Noble
                                                    </span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-4">
                                <label for="due-date" class="form-label">Due Date</label>
                                <input type="text" class="form-control" id="due-date" data-provider="flatpickr" placeholder="Select date">
                            </div>
                            <!--end col-->
                            <div class="col-lg-4">
                                <label for="categories" class="form-label">Tags</label>
                                <input type="text" class="form-control" id="categories" placeholder="Enter tag">
                            </div>
                            <!--end col-->
                            <div class="col-lg-4">
                                <label for="tasks-progress" class="form-label">Tasks Progress</label>
                                <input type="text" class="form-control" maxlength="3" id="tasks-progress" placeholder="Enter progress">
                            </div>
                            <!--end col-->
                            <div class="mt-4">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success">Add Task</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end add board modal-->

    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="delete-btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this tasks ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-record">Yes, Delete It!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->

@endsection
@push('js_stack')
    <script>
 


 
</script>
@endpush