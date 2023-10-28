<form action="" method="get">
    <div class="row d-flex justify-content-between align-items-center pb-4 mt-3">
        {{-- <div class="col-md-3 ">
            <label for="" class="col-form-label" >Son möhlət</label>
            <select name="dedline" class="form-control" id="" >
                <option value="bitib">Bitib</option>
                
            </select>
        </div> --}}
        <div class="col-md-4">
            {{-- <label for="" class="col-form-label" >Status</label> --}}
            <select name="status" class="form-control filter" data-filter="status" id="">
                <option value="" selected disabled>Status seçin</option>

                @foreach ($statuses as $status)
                    <option @if (request()->get('status') == $status->id) selected @endif value="{{ $status->id }}">
                        {{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            {{-- <label for="" class="col-form-label" >Prioritet</label> --}}
            <select name="priority" class="form-control filter mt-20-res" data-filter="priority" id="">
                <option value="" selected disabled>Prioritet seçin</option>

                @foreach ($prioritetes as $priority)
                    <option @if (request()->get('priority') == $priority->id) selected @endif value="{{ $priority->id }}">
                        {{ $priority->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <div class="d-flex flex-column-res gap-10px">
                <button class="btn btn-success btn-block">
                    <i class="fas fa-filter"></i>
                    Filtr
                </button>
                <a href="{{ route('task.index') }}" class="btn btn-info btn-block">
                    <i class="fa-solid fa-filter-circle-xmark"></i>
                    Sıfırla
                </a>
            </div>
        </div>
        {{-- <div class="col-md-4">
            <div class="d-flex flex-column-res justify-content-end gap-10px">
                <div class="dt-buttons btn-group">
                    <button class="btn css-button btn-success btn-block">
                        <i class="fas fa-filter"></i>
                        Filtr
                    </button>
                </div>

                <div class="dt-buttons btn-group">
                    <a href="{{ route('task.index') }}" class="btn css-button btn-info btn-block">
                        <i class="fa-solid fa-filter-circle-xmark"></i>
                        Sıfırla
                    </a>
                </div>

            </div>
        </div> --}}
    </div>
</form>
