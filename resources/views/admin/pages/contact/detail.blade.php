<div class="modal-body">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label class="form-label">ID:</label>
            <input type="text" class="form-control" value="{{ $item->id ?? '' }}" disabled>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Name:</label>
            <input type="text" class="form-control" value="{{ $item->name ?? '' }}" disabled>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Surname:</label>
            <input type="text" class="form-control" value="{{ $item->surname ?? '' }}" disabled>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" value="{{ $item->email ?? '' }}" disabled>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Phone:</label>
            <input type="text" class="form-control" value="{{ $item->phone ?? '' }}" disabled>
        </div>
        <div class="col-12 mb-3">
            <label class="form-label">Message:</label>
            <textarea class="form-control" rows="3" disabled>{{ $item->message ?? '' }}</textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Read:</label>
            <input type="text" class="form-control"
                value="{{ isset($item->read) ? ($item->read ? 'Read' : 'Unread') : 'N/A' }}" disabled>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Created At:</label>
            <input type="datetime" class="form-control" value="{{ $item->created_at ?? '' }}" disabled>
        </div>
    </div>
</div>
