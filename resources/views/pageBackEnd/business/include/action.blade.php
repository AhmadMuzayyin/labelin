<td>
    @can('business_detail')
    <a href="{{ route('business.show', $model->id) }}" class="btn btn-sm btn-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>
    @endcan

    @can('business_update')
        <a href="{{ route('business.edit', $model->id) }}" class="btn btn-sm btn-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('business_delete')
        <form action="{{ route('business.destroy', $model->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-sm btn-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>
