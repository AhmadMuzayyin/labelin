<td>
    <a href="{{ route('user.scan.show', $id_qrcode) }}" class="btn btn-sm btn-primary btn-sm">
        <i class="fa fa-eye"></i>
    </a>

    <form action="{{ route('kunci') }}" method="post" class="d-inline">
        @csrf
        @method('patch')
        <input type="hidden" name="id" value="{{ $id_qrcode }}">
        <input type="hidden" name="status" value="{{ $status }}">
        <button class="btn btn-sm {{ $status == false ? 'btn-warning' : 'btn-success' }} btn-sm">
            @if ($status == false)
                <i class="fa-solid fa-lock-open"></i>
            @else
                <i class="fa-solid fa-lock"></i>
            @endif
        </button>
    </form>
</td>
