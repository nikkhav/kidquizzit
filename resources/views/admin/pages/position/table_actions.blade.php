<button class='btn btn-sm btn-danger destroy' title='Sil' data-id="{{ $item->id }}"
    route="{{ route('position.destroy', 'destroy') }}"><i class=' ri-delete-bin-2-line'></i></button>
<button class='btn btn-sm btn-info edit' title='Düzənlə' data-id="{{ $item->id }}"><i class='fas fa-pen'></i></button>
