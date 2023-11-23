<button class='btn btn-danger destroy btn-sm' title='Delete' data-id="{{ $item->id }}"
    route="{{ route('tale.destroy', 'destroy') }}"><i class='fas fa-trash'></i></button>
<button class='btn btn-info btn-sm edit' title='Edit' data-id="{{ $item->id }}"><i class='fas fa-pen'></i></button>
