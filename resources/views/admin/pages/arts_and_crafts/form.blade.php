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
        <label class="small mb-1" for="edit-description">Description</label>
        <textarea class="form-control" style="resize: none;" name="description" id="edit-description" placeholder="Add Description" rows="15" required>{{ old('description', $item->description) }}</textarea>
        <div id="error-edit-description" class="error text-danger"></div>
    </div>
    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $item->category_id) selected @endif>{{ strip_tags($category->title) }}</option>
                @endforeach
                <option value="999" @if ($item->category_id == 999) selected @endif>Arts and Crafts</option>
            </select>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('edit-description');
    CKEDITOR.replace('edit-title');
</script>
