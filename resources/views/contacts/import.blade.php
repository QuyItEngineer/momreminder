@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Contacts</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                {{Form::open(['route' => 'contacts.import_data', 'files' => true])}}
                    <div class="form-group">
                        <label for="" class="col-md-3" style="text-align: right;margin-top: 7px;">File </label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="file" id="validatedCustomFile" required="true">
                            <span class="help-inline">Format: <i>Name;Phone;Email;</i></span>
                        </div>
                    </div>
                    <!-- Group Field -->
                    <div class="form-group col-sm-12" style="margin-top: 15px">
                        <label for="to_date" class="col-md-3" style="text-align: right;margin-top: 7px;">Group:</label>
                        {!! Form::hidden('group', false) !!}
                        <div class="col-md-9">
                        @if( ! empty($groups))
                            @foreach ($groups as $group)
                                <div>
                                    {!! Form::checkbox('groups[]', $group['id'], null, array('id'=>$group['id'])) !!} {{$group['name']}}
                                </div>
                            @endforeach
                        @endif
                        </div>
                    </div>
                    <!-- Submit Field -->
                    <div class="form-group col-sm-12" style="text-align: center">
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('contacts.index') !!}" class="btn btn-default">Cancel</a>
                    </div>
                {{Form::close()}}
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection