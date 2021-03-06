@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Group
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body groups-store">
                <div class="row">
                    {!! Form::open(['route' => 'groups.store']) !!}

                        @include('groups.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
