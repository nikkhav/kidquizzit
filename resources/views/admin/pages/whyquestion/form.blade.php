<input type="hidden" name="id" id="edit-id" value="{{ $item->id }}">
<div class="row">
    <div class="col-md-12 mt-2">
        <label for="image">Image</label>
        <div class="form-group">
            <img src="{{ asset('storage/' . '/' . $item->image) }}" alt="Old Image" width="300" height="200">
            <input type="file" name="image" id="image" class="form-control mt-2">
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <label class="small mb-1" for="inputFirstName">Title</label>
        <input class="form-control" name="title" value="{{ old('title', $item->title) }}"
            id="inputFirstName" type="text" placeholder="Add title" required>
    </div>
    <div class="col-md-12 mb-3">
        <label class="small mb-1" for="inputDescription">Description</label>
        <textarea class="form-control" style="resize: none;" name="description" id="inputDescription"
            placeholder="Add Description" rows="15" required>{{ old('description', $item->description) }}</textarea>
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
