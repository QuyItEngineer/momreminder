@if(str_contains(\Route::currentRouteAction(), 'create'))
    <div>
        <contact-form></contact-form>
    </div>
    <div class="form-group col-xs-offset-3 col-xs-6">
        {!! Form::label('groups[]', 'Groups:') !!}
        @foreach($groups as $group)
            <c-checkbox name="groups[]" value="{{$group->id}}" label="{{$group->name}}"></c-checkbox>
        @endforeach
    </div>
    <div class="form-group col-xs-offset-3 col-xs-6">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('contacts.index') !!}" class="btn btn-default">Cancel</a>
    </div>
@else
    <div class="contact-form-edit" style="width: 50%; margin: auto;">
        <!-- Name Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Phone Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('phone', 'Phone:') !!}
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Email Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Group Field -->
        <div class="form-group col-sm-12">
            <label for="to_date">Group:</label>
            {!! Form::hidden('group', false) !!}
            @if( ! empty($groups))
                @foreach ($groups as $group)
                    <div>
                        {!! Form::checkbox('groups[]', $group['id'], null, array('id'=>$group['id'])) !!} {{$group['name']}}
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Birthday Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('birthday', 'Birthday:') !!}
            {{--        {!! Form::date('birthday', isset($contact->birthday)? date('d/m/Y',strtotime($contact->birthday)):"-", ['class' => 'form-control', 'data-date-format' => 'dd-mm-yyyy']) !!}--}}
            {!! Form::date('birthday', $contact->birthday, ['class' => 'form-control', 'data-date-format' => 'dd-mm-yyyy']) !!}
        </div>

        <!-- Member Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('member', 'Member:') !!}
            {!! Form::select('member', $member, null, ['id' => 'member','class'=>'form-control']) !!}
        </div>

        <!-- Status Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select('status', $status, null, ['id' => 'status','class' => 'form-control']) !!}
        </div>

        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{!! route('contacts.index') !!}" class="btn btn-default">Cancel</a>
        </div>
    </div>
@endif
