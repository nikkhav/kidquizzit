<div class="form-group">
    <label for="category" class="form-label ">{{ isset($__FILE_SELECTOR_TITLE) ? $__FILE_SELECTOR_TITLE: 'File' }}</label>
    <input name="{{ isset($__FILE_SELECTOR_NAME) ? $__FILE_SELECTOR_NAME: 'selected_file' }}" class="form-control filestyle" type="file" accept="{{ isset($__FILE_SELECTOR_ACCEPT) ? $__FILE_SELECTOR_ACCEPT: '*' }}" data-buttonname="btn-secondary">
    @if(isset($__FILE_OBJ))
    <input type="hidden" class="hidden" name="{{ $__FILE_OBJ->id }}">
    @endif
    @if(isset($__FILE_OBJ) and $__FILE_OBJ->isImage())
        <div style="background-image: url('{{ $__FILE_OBJ->image_thumb_back }}');
        height: 150px; width: 150px;
        background-size: cover;background-position: center;
        background-repeat: no-repeat;"></div>
    @endif
</div>
