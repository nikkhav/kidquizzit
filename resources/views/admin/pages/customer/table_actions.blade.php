<button class='btn btn-danger destroy btn-sm' title='Sil' data-id="{{ $item->id }}"
    route="{{ route('customer.destroy', 'destroy') }}"><i class=' ri-delete-bin-2-line'></i></button>
<button class='btn btn-info btn-sm edit' title='Düzənlə' data-id="{{ $item->id }}"><i class='fas fa-pen'></i></button>
