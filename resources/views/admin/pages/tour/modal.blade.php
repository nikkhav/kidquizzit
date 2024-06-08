<div class="modal fade create-modal" id="create-modal" tabindex="-1" aria-labelledby="createTourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTourLabel">Create Tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-tour-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label class="small mb-1" for="image">Image</label>
                                <input type="file" id="image" name="image" class="form-control">
                                <div id="image-error" class="error text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="small mb-1" for="title">Title</label>
                            <textarea class="form-control" name="title" id="title" placeholder="Add title" required></textarea>
                            <div id="title-error" class="error text-danger"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="small mb-1" for="description1">Description 1</label>
                            <textarea class="form-control" name="description1" id="description1" placeholder="Add Description 1" rows="4" required></textarea>
                            <div id="description1-error" class="error text-danger"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="small mb-1" for="description2">Description 2</label>
                            <textarea class="form-control" name="description2" id="description2" placeholder="Add Description 2" rows="4" required></textarea>
                            <div id="description2-error" class="error text-danger"></div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ strip_tags($category->title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city_id">City</label>
                                <select name="city_id" id="city_id" class="form-control">
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="save-tour">Add</button>
            </div>
        </div>
    </div>
</div>
