@if($notifications->count() > 0)
@foreach ($notifications as $notification)
<div class="text-reset notification-item d-block dropdown-item position-relative">
    <div class="d-flex">
        <div class="avatar-xs me-3">
            <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                <i class="bx bx-badge-check"></i>
            </span>
        </div>
        <div class="flex-1">
            {{-- <a href="#!" class="stretched-link"> --}}
                <h6 class="mt-0 mb-2 lh-base">{{$notification->user->fullname}}
                    {{$notification->action}}  
                     <a href="{{route('task.detail.page', $notification->task->id)}} ">{{strip_tags($notification->task->title)}}</a>
                </h6>
            {{-- </a> --}}
            <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                <span><i class="mdi mdi-clock-outline"></i> Just 30 sec
                    ago</span>
            </p>
        </div>
        <div class="px-2 fs-15">
            <div class="form-check notification-check">
                <input class="form-check-input" type="checkbox" value=""
                    id="all-notification-check01">
                <label class="form-check-label"
                    for="all-notification-check01"></label>
            </div>
        </div>
    </div>
</div>
@endforeach
@else
<div class="w-25 w-sm-50 pt-3 mx-auto">
<img src="{{ asset('admin/assets/images/svg/bell.svg') }}"
    class="img-fluid" alt="user-pic">
</div>
<div class="text-center pb-5 mt-2">
<h6 class="fs-18 fw-semibold lh-base">Hey! You have no any notifications
</h6>
</div>
@endif