<div class="modal fade create-modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Arts and Crafts Create</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label class="small mb-1" for="image">Image</label>
                                <input type="file" id="image" name="image" class="form-control about-img">
                                <div id="image-error" class="error text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="small mb-1" for="title">Title</label>
                            <textarea class="form-control" name="title" id="title" placeholder="Add title" required></textarea>
                            <div id="title-error" class="error text-danger"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="small mb-1" for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Add Description" rows="15" required></textarea>
                            <div id="description-error" class="error text-danger"></div>
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
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="save-arts_and_crafts">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="arts_and_crafts-modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Arts and Crafts Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="inputs">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="edit-arts_and_crafts">Edit</button>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('description');
    CKEDITOR.replace('title');
</script>
