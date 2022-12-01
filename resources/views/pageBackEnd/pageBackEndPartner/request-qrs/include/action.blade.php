<td>
    @if (!$model->bukti_pembayaran)
        <a href="/partner/request-qrs/{{ $model->id }}/upload">
            <button class="btn btn-warning btn-sm">
                <i class="ace-icon fa fa-upload"></i>
            </button>
        </a>
    @endif
{{--
    @if ($model->bukti_pembayaran)
        <a href="{{ route('request-qrs.download', $model->bukti_pembayaran) }}" target="_blank">
            <button class="btn btn-secondary btn-sm">
                <i class="ace-icon fa fa-download"></i> Download Bukti Bayar
            </button>
        </a>
    @endif --}}

    <a href="{{ route('request-qrs.show', $model->id) }}">
        <button class="btn btn-success btn-sm">
            <i class="ace-icon fa fa-eye"></i>
        </button>
    </a>

    @if (in_array($model->status, ['Waiting Payment']))
        <a href="{{ route('request-qrs.edit', $model->id) }}" class="btn btn-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>

        <form action="{{ route('request-qrs.destroy', $model->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')
            <button class="btn btn-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endif
</td>
