<button class='btn btn-info btn-sm show-details' title='Show details' data-id="{{ $item->id }}"
    data-status="{{ $item->read }}">
    @if ($item->read)
        <i class="fas fa-eye"></i>
    @else
        <i class="fas fa-eye-slash"></i>
    @endif
</button>

<button class='btn btn-danger destroy btn-sm' title='Delete' data-id="{{ $item->id }}"
    route="{{ route('contact.destroy', 'destroy') }}"><i class='fas fa-trash'></i></button>
