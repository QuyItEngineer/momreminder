<div class="col-sm-6">
    <div class="form-group text-center">
        <img width="300" height="300" src="{{ get_avatar($user) }}" alt="" class="img-circle">
        {!! Form::file('avatar_file', ['class' => 'form-control', 'style' => 'margin-top: 40px']) !!}
    </div>
</div>
<div class="col-sm-6">
    <!-- Username Field -->
    <div class="form-group">
        {!! Form::label('username', 'Username:') !!}
        {!! Form::text('username', null, ['class' => 'form-control', 'readonly' => isset($user)]) !!}
    </div>

    <!-- Email Field -->
    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'readonly' => isset($user)]) !!}
    </div>

    <!-- Phone Field -->
    <div class="form-group">
        {!! Form::label('phone', 'Phone:') !!}
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Full Name Field -->
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Address Field -->
    <div class="form-group">
        {!! Form::label('address', 'Address:') !!}
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Password Field -->
    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    @if(isset($user))
        <div class="form-group">
            <label for="credit_card_amount">Credits:</label>
            <input type="text" value="{{$user->credit ?$user->credit: 0 }}"
                   disabled
                   readonly
                   id="credit_card" class="form-control">
        </div>
    @endif

    <!-- Credit card Field -->
    <update-credit-card-form stripe-key="{{config('services.stripe.key')}}"
                             crfs="{{csrf_token()}}"
                             stripe_id="{{!empty($user->stripe_id) ? $user->stripe_id : null}}"
                             card_last_four="{{$user->card_last_four}}"></update-credit-card-form>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>


