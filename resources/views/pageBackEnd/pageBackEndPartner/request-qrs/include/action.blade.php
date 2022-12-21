<td>
    <div class="d-flex">
        @if (!$model->bukti_pembayaran)
            <a href="/partner/request-qrs/{{ $model->id }}/upload">
                <button class="btn btn-warning btn-sm mx-1">
                    <i class="ace-icon fa fa-upload"></i>
                </button>
            </a>
        @endif
        <a href="{{ route('request-qrs.show', $model->id) }}">
            <button class="btn btn-success btn-sm mx-1">
                <i class="ace-icon fa fa-eye"></i>
            </button>
        </a>

        @if (in_array($model->is_generate, ['Sudah Generate']))
            <a href="{{ route('request-qrs.export', $model->id) }}">
                <button class="btn btn-warning btn-sm mx-1">
                    <i class="ace-icon fa fa-arrow-down"></i>
                </button>
            </a>
        @endif
    </div>
</td>
