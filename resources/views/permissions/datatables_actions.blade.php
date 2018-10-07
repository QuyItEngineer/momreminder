{!! Form::open(['route' => ['permissions.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('permissions.read')
        <a href="{{ route('permissions.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
    @can('permissions.update')
        <a href="{{ route('permissions.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="glyphicon glyphicon-edit"></i>
        </a>
    @endcan
    @can('permissions.delete')
        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
