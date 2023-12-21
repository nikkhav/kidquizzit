<input type="hidden" name="id" id="edit-id" value="{{ $item->id }}">
<div class="row">
    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label for="name">Title</label>
            <textarea name="title" id="edit-title"  class="form-control"
                placeholder="Title" aria-describedby="helpId" required>{{ $item->title }}</textarea>
            <div id="error-edit-title" class="error text-danger"></div>

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

<script>
    CKEDITOR.replace('edit-title');
</script>
