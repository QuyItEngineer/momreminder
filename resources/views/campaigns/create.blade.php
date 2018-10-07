@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Campaign
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'campaigns.store', 'files' => true]) !!}

                        @include('campaigns.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
