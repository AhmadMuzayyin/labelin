<td>
    <a href="{{ route('sosmed.edit', $model->id) }}" class="btn btn-sm btn-primary btn-sm">
        <i class="fa fa-pencil-alt"></i>
    </a>

    <form action="{{ route('sosmed.destroy', $model->id) }}" method="post" class="d-inline"
        onsubmit="return confirm('Are you sure to delete this record?')">
        @csrf
        @method('delete')

        <button class="btn btn-sm btn-danger btn-sm">
            <i class="ace-icon fa fa-trash-alt"></i>
        </button>
    </form>
</td>
