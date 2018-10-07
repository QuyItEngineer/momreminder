@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Email Queues</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        {{--@include('flash::message')--}}

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open() !!}
                    <div class="form-group  col-md-6 col-md-offset-3 col-xs-offset-0 col-xs-12">
                        <div>
                            <h3>General Settings</h3>
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::label('to_email', 'System Email:') !!}
                            {!! Form::text('system_email', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-12">
                            {!! Form::label('to_email', 'Email Type:') !!}
                            {!! Form::select('email_type', ['text'=>'TEXT', 'html'=>'HTML'],null, ['class' => 'form-control']) !!}
                        </div>

                        <setting-email-form></setting-email-form>

                        <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            <a href="{!! route('emailQueues.index') !!}" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open() !!}
                    <div class="form-group col-md-6 col-md-offset-3 col-xs-offset-0 col-xs-12">
                        <h3>Test Email Settings</h3>
                        <p>
                            Enter an email address below to verify that your email settings are working.<br>
                            Please save the current settings before testing.
                        </p>
                    </div>
                    <div class="form-group  col-md-6 col-md-offset-3 col-xs-offset-0 col-xs-12">
                        <!-- To Email Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::label('to_email', 'Email:') !!}
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            <a href="{!! route('emailQueues.index') !!}" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

