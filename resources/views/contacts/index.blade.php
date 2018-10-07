@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Contacts</h1>
        <h1 class="pull-right" style="display: inline">
            <form method="GET" action="{!! route('export.download') !!}" style="display: inline;">
                <button type="submit" class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px">
                    <span class="fa fw fa-cloud-download"></span> Download Example</button>
            </form>
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('contacts.import') !!}"><span class="fa fw fa-cloud-download"></span> Import</a>
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('contacts.create') !!}"><span class="fa fw fa-user-plus"></span> Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('contacts.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

