<div class="modal fade create-modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <textarea name="title" id="title" class="form-control"
                                    placeholder="Enter title" aria-describedby="helpId" required></textarea>
                            </div>
                            <div id="title-error" class="error text-danger"></div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label for="parent_id">Parent</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">Main</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ strip_tags($category->title) }}</option>
                                        @foreach ($category->childCategories as $childCategory)
                                            <option value="{{ $childCategory->id }}"> - {{ strip_tags($childCategory->title) }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success " id="save-category">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="category-modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Category edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form">
                    @csrf
                    @method('PUT')
                    <div id="inputs">

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success " id="edit-category">Edit</button>
            </div>
        </div>
    </div>
</div>
