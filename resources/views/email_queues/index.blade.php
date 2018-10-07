@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Email Queues</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(array('url' => '/emailQueues/index', 'method' => 'post')) !!}
                    <div class="form-group  col-md-6 col-md-offset-3 col-xs-offset-0 col-xs-12">
                        <div>
                            <h3>General Settings</h3>
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::label(null, 'System Email:') !!}
                            {!! Form::text('sender_email', $settings['sender_email'], ['class' => 'form-control']) !!}
                            <div style="font-size: 12px;">The email that all system-generated emails are sent from.</div>
                        </div>

                        <div class="form-group col-sm-12">
                            {!! Form::label(null, 'Email Type:') !!}
                            {!! Form::select('mailtype', ['text'=>'TEXT', 'html'=>'HTML'], $settings['mailtype'], ['class' => 'form-control']) !!}
                        </div>

                        <setting-email-form
                                @if(isset($settings)) :model='{{json_encode($settings)}}' @endif
                                :sendmail='{!! json_encode($settings['sender_email']) !!}'></setting-email-form>

                        <div class="form-group col-sm-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(array('url' => '/emailQueues/test-email-setting', 'method' => 'post')) !!}
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
                            {!! Form::label(null, 'Email:') !!}
                            {!! Form::text('site_system_email', $system_email, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
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

