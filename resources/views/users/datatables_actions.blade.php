{!! Form::open(['route' => ['users.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('users.read')
        <a href="{{ route('users.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
    @can('users.update')
        <a href="{{ route('users.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="glyphicon glyphicon-edit"></i>
        </a>
    @endcan
    @can('users.delete')
        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
