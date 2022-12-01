<td>
    @can('partner_detail')
    <a href="{{ route('partners.show', $model->id) }}" class="btn btn-sm btn-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>
    @endcan

    @can('partner_update')
        <a href="{{ route('partners.edit', $model->id) }}" class="btn btn-sm btn-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('partner_delete')
        <form action="{{ route('partners.destroy', $model->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-sm btn-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan

    @can('business_partner')
        <a href="{{ route('business-partners.get', $model->id) }}" class="btn btn-sm btn-warning btn-sm">
            <i class="fa fa-list"></i> List Bisnis
        </a>
    @endcan
</td>
