<div class="modal fade create-modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tours Create</h5>
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
                            <textarea class="form-control" name="title" id="title"
                                      placeholder="Add title" required></textarea>
                            <div id="title-error" class="error text-danger"></div>

                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="small mb-1" for="description">Description 1</label>
                            <textarea class="form-control" name="description1" id="description1" placeholder="Add Description" rows="15"
                                      required></textarea>
                            <div id="description1-error" class="error text-danger"></div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="small mb-1" for="description2">Description 2</label>
                            <textarea class="form-control" name="description2" id="description2" placeholder="Add Description" rows="15"></textarea>
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
                <button type="button" class="btn btn-success " id="save-category">Add</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="customer-type-modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tours Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="inputs">



                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success " id="edit-customer-type">Edit</button>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('description1');
    CKEDITOR.replace('description2');

    CKEDITOR.replace('title');

</script>
