@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Packages</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @foreach($packages as $package)
                    <div class="box-body row list-credit" style="background-color: #F8FCFC; margin-bottom: 10px;">
                        <div class="col-xs-6 col-sm-12 col-md-4 header-package">
                            <h3>{{$package->name}}</h3>
                            <div style="margin-top: 40px;">
                                <p>{!! $package->description !!}</p>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-4">
                            <div style="display: flex;">
                                <span class="fa fw fa-usd" style="padding-top: 5%"></span><h2>{{$package->price}}</h2>
                            </div>
                            <div class="generate_credit">
                                <h4>have: {{$package->credit}} Credits</h4>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <charge-credit credit="{{$package->credit}}"></charge-credit>
                        </div>
                    </div>
                @endforeach
                <div class="box-body row list-credit" style="background-color: #F8FCFC; margin-bottom: 10px;">
                    <div class="col-xs-6 col-sm-12 col-md-4 header-package">
                        <h3>Custom credit:</h3>
                    </div>
                    <div class="col-xs-6 col-sm-12 col-md-8" style="margin-top: 15px;">
                        <custom-charge-credit></custom-charge-credit>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

