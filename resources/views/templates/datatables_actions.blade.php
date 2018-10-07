{!! Form::open(['route' => ['templates.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('templates.read')
        <a href="{{ route('templates.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
    @can('templates.update')
        <a href="{{ route('templates.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="glyphicon glyphicon-edit"></i>
        </a>
    @endcan
    @can('templates.delete')
        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
