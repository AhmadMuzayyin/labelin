<td>
    @if (!$model->bukti_pembayaran)
        <a href="/partner/request-qrs/{{ $model->id }}/upload">
            <button class="btn btn-warning btn-sm">
                <i class="ace-icon fa fa-upload"></i>
            </button>
        </a>
    @endif
    <div class="d-flex">
        <a href="{{ route('request-qrs.show', $model->id) }}">
            <button class="btn btn-success btn-sm mx-2">
                <i class="ace-icon fa fa-eye"></i>
            </button>
        </a>
        <a href="{{ route('request-qrs.export', $model->id) }}" >
            <button class="btn btn-warning btn-sm">
                <i class="fa fa-arrow-down"></i>
            </button>
        </a>
    </div>

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