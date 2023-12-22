<input type="hidden" name="id" id="edit-id" value="{{ $item->id }}">
<div class="row">
    <div class="col-md-12 mt-2">
        <label for="image1">Image 1</label>
        <div class="form-group">
            <img src="{{ asset('storage/' . '/' . $item->image1) }}" alt="Old Image" width="300" height="200">
            <input type="file" name="image1" id="edit-image1" class="form-control mt-2">
            <div id="error-edit-image1" class="error text-danger"></div>

        </div>
    </div>
    <div class="col-md-12 mt-2">
        <label for="image2">Image 2</label>
        <div class="form-group">
            <img src="{{ asset('storage/' . '/' . $item->image2) }}" alt="Old Image" width="300" height="200">
            <input type="file" name="image2" id="edit-image2" class="form-control mt-2">
            <div id="error-edit-image2" class="error text-danger"></div>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <label class="small mb-1" for="inputFirstName">Title</label>
        <textarea class="form-control" name="title" id="edit-title"
             placeholder="Add title" required>{{ old('title', $item->title) }}</textarea>
        <div id="error-edit-title" class="error text-danger"></div>

    </div>
    <div class="col-md-12 mb-3">
        <label class="small mb-1" for="inputDescription">Description</label>
        <textarea class="form-control" style="resize: none;" name="description" id="edit-description"
            placeholder="Add Description" rows="15" required>{{ old('description', $item->description) }}</textarea>
        <div id="error-edit-description" class="error text-danger"></div>
    </div>
    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $item->category_id) selected @endif>
                        {{ strip_tags($category->title) }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('edit-description');
    CKEDITOR.replace('edit-title');

</script>
