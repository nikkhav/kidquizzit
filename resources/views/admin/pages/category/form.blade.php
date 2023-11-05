<input type="hidden" name="id" id="edit-id" value="{{ $item->id }}">
<div class="row">
    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label for="name">Title</label>
            <input type="text" name="title" id="edit-title" value="{{ $item->title }}" class="form-control"
                placeholder="Title" aria-describedby="helpId">
        </div>
        <div id="error-edit-title" class="error text-danger"></div>
    </div>
    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label for="parent_id">Parent</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">Main</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $item->parent_id) selected @endif>
                        {{ $category->title }}
                    </option>
                    @foreach ($category->childCategories as $childCategory)
                        <option value="{{ $childCategory->id }}" @if ($childCategory->id == $item->parent_id) selected @endif>
                            - {{ $childCategory->title }}
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>
    </div>

</div>
