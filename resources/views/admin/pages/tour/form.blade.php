<input type="hidden" name="id" id="edit-id" value="{{ $item->id }}">
<div class="row">
    <div class="col-md-12 mt-2">
        <label for="image">Image</label>
        <div class="form-group">
            <img src="{{ asset('storage/' . '/' . $item->image) }}" alt="Old Image" width="300" height="200">
            <input type="file" name="image" id="edit-image" class="form-control mt-2">
            <div id="error-edit-image" class="error text-danger"></div>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <label class="small mb-1" for="inputFirstName">Title</label>
        <textarea class="form-control" name="title" id="edit-title"
                  placeholder="Add title" required> {{ old('title', $item->title) }}</textarea>
        <div id="error-edit-title" class="error text-danger"></div>

    </div>
    <div class="col-md-12 mb-3">
        <label class="small mb-1" for="inputDescription">Description 1</label>
        <textarea class="form-control" style="resize: none;" name="description1" id="edit-description1"
                  placeholder="Add Description" rows="15" required>{{ old('description', $item->description1) }}</textarea>
        <div id="error-edit-description1" class="error text-danger"></div>
    </div>


    <div class="col-md-12 mb-3">
        <label class="small mb-1" for="description2">Description 2</label>
        <textarea class="form-control" style="resize: none;" name="description2" id="edit-description2"
                  placeholder="Add Description" rows="15">{{ old('description2', $item->description2) }}</textarea>
        <div id="error-edit-description2" class="error text-danger"></div>
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

    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label for="city_id">City</label>
            <select name="city_id" id="city_id" class="form-control">
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" @if ($city->id == $item->city_id) selected @endif>{{ strip_tags($city->name) }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('edit-description1');
    CKEDITOR.replace('edit-description2');
    CKEDITOR.replace('edit-title');
</script>


<script>
    CKEDITOR.replace('edit-description1');
    CKEDITOR.replace('edit-description2');

    CKEDITOR.replace('edit-title');

</script>
