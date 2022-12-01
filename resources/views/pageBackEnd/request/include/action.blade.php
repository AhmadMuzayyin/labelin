<td>
    <a href="{{ route('requestAll.show', $model->id) }}">
        <button class="btn btn-success btn-sm">
            <i class="ace-icon fa fa-eye"></i>
        </button>
    </a>
    {{-- @if ($model->bukti_pembayaran)
    <a href="{{ route('request-qrs.download', $model->bukti_pembayaran) }}" target="_blank">
        <button class="btn btn-secondary btn-sm">
            <i class="ace-icon fa fa-download"></i> Bukti Bayar
        </button>
    </a>
    @endif
    @if (!$model->bukti_pembayaran)
    <button class="btn btn-danger btn-sm" disabled>
        <i class="ace-icon fa fa-download"></i> Bukti Bayar
    </button>
    @endif
    <a href="" class="btn btn-sm btn-primary btn-sm">
        <i class="fa fa-pencil-alt"></i> Update Status
    </a> --}}
</td>
