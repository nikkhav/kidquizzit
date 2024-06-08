<div class="modal fade edit-modal" id="edit-modal" tabindex="-1" aria-labelledby="editTourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTourLabel">Edit Tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-tour-form" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit-id" value="{{ $item->id }}">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="image">Image</label>
                            <div class="form-group">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Old Image" width="300" height="200">
                                <input type="file" name="image" id="edit-image" class="form-control mt-2">
                                <div id="error-edit-image" class="error text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="small mb-1" for="edit-title">Title</label>
                            <textarea class="form-control" name="title" id="edit-title" placeholder="Add title" required>{{ old('title', $item->title) }}</textarea>
                            <div id="error-edit-title" class="error text-danger"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="small mb-1" for="edit-description1">Description 1</label>
                            <textarea class="form-control" style="resize: none;" name="description1" id="edit-description1" placeholder="Add Description 1" rows="15" required>{{ old('description1', $item->description1) }}</textarea>
                            <div id="error-edit-description1" class="error text-danger"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="small mb-1" for="edit-description2">Description 2</label>
                            <textarea class="form-control" style="resize: none;" name="description2" id="edit-description2" placeholder="Add Description 2" rows="15" required>{{ old('description2', $item->description2) }}</textarea>
                            <div id="error-edit-description2" class="error text-danger"></div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if ($category->id == $item->category_id) selected @endif>{{ strip_tags($category->title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city_id">City</label>
                                <select name="city_id" id="city_id" class="form-control">
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" @if ($city->id == $item->city_id) selected @endif>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="update-tour">Edit</button>
            </div>
        </div>
    </div>
</div>
