<td class="text-center">
    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('roles.destroy', $model->id) }}" method="POST">
        @can('role_detail')
        <a href="{{ route('roles.show', $model->id) }}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> </a>
        @endcan
        @can('role_update')
        <a href="{{ route('roles.edit', $model->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> </a>
        @endcan
        @csrf
        @method('DELETE')
        @can('role_delete')
        <button type="submit" class="btn btn-sm btn-danger" {{ $model->id == 1 ? 'disabled' : null }}><i class="fas fa-trash-alt"></i> </button>
        @endcan
    </form>
</td>
