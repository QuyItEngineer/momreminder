@extends('layouts.app')

@section('content')
    <section class="content-header">
        <span class="pull-right label label-default">{{date('D, M d')}}</span>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua" style="border-radius: 5px;">
                    <div class="inner">
                        <h3>{{$total_users}}</h3>

                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green" style="border-radius: 5px;">
                    <div class="inner">
                        <h3>{{$total_messages}}</h3>

                        <p>Total SMS/MMS</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-email"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow" style="border-radius: 5px;">
                    <div class="inner">
                        <h3>{{$total_calls}}</h3>

                        <p>Total Voices</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-microphone"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            @role('user')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red" style="border-radius: 5px;">
                    <div class="inner">
                        <h3>{{$total_replies}}</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            @endrole
        </div>
        <div class="row">
            @can('activities.read')
            <div class="col-sm-6">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Member Activities</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-responsive">
                            @foreach($activities as $activity)
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-alert"></span>
                                    </td>
                                    <td>({{$activity->user->name}}) {!! $activity->activity !!} </td>
                                    <td>{{$activity->created_at}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
@endsection
