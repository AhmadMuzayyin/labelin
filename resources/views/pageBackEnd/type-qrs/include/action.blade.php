<td>
    @can('type_qr_detail')
    <a href="{{ route('type-qrs.show', $model->id) }}" class="btn btn-sm btn-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>
    @endcan

    @can('type_qr_update')
        <a href="{{ route('type-qrs.edit', $model->id) }}" class="btn btn-sm btn-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('type_qr_delete')
        <form action="{{ route('type-qrs.destroy', $model->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-sm btn-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>
