<input type="hidden" name="id" id="edit-id" value="{{ $item->id }}">
<div class="row">
    <div class="col-md-12 mt-2">
        <label for="image">Image</label>
        <div class="form-group">
            <img src="{{ asset('storage/' . '/' . $item->image) }}" alt="Old Image" width="300" height="200">
            <input type="file" name="image" id="image" class="form-control mt-2">
        </div>
    </div>
    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $item->category_id) selected @endif>
                        {{ $category->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
