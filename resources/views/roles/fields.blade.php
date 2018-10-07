<div class="col-sm-12">
    <h3>Role Details</h3>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Guard Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('guard_name', 'Guard Name:') !!}
    {!! Form::text('guard_name', null, ['class' => 'form-control']) !!}
</div>
@if(isset($role))
    <div class="col-sm-12">
        <h3>Permissions: {{$role->name}}</h3>
        <p>Check all permissions that apply to this Role.</p>
    </div>

    <div class="col-sm-12">
        @php($groupedPermissions = $permissions->mapToGroups(function($item, $key) {
            list($name) = explode('.',$item['name']);
            return [$name => $item];
        }))
        @foreach($groupedPermissions as $group => $gpermissions)
            <h4><b>{{ucfirst($group)}}</b></h4>
            <table class="table table-primary table-responsive">
                <thead>
                <tr>
                    @foreach($gpermissions as $permission)
                        @php(list(,$name) = explode('.',$permission->name))
                        <td>{{ucfirst($name)}}</td>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($gpermissions as $permission)
                        @php(list(,$name) = explode('.',$permission->name))
                        <td>
                            <div class="checkbox icheck">
                                <label>
                                    <input name="permissions[]" title="{{$permission->name}}"
                                           {{$role->hasPermissionTo($permission) ? 'checked' : null}} type="checkbox"
                                           value="{{$permission->name}}"/>
                                </label>
                            </div>
                        </td>
                    @endforeach
                </tr>
                </tbody>
            </table>
        @endforeach
    </div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('roles.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });

        });
    </script>
@endsection
