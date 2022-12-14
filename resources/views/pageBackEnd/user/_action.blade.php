<td>
    @can('user_update')
        <a href="{{ route('user.edit', $model->id) }}" class="btn btn-sm btn-primary">
            <i class="fas fa-edit"></i>
        </a>
    @endcan

    @can('user_delete')
        <form action="{{ route('user.destroy', $model->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
            @csrf
            @method('delete')
            <button class="btn btn-sm btn-danger">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>
