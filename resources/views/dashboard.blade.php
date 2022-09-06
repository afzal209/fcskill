@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>Dashboard</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>List of total records</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">

        <div class="row animated fadeInRightBig">
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            {{-- <span class="label label-success float-right"></span> --}}
                        </div>
                        <h5>Forex Users</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $forex_users }}</h1>
                        {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                        <small>Total</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            {{-- <span class="label label-info float-right">Annual</span> --}}
                        </div>
                        <h5>Crypto Users</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $crypto_users }}</h1>
                        {{-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> --}}
                        <small>Total</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            {{-- <span class="label label-primary float-right">Today</span> --}}
                        </div>
                        <h5>Both (Forex & Crypto) Users</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $both_users }}</h1>
                        {{-- <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div> --}}
                        <small>Total</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row animated fadeInRightBig">

            <h5 style="margin-left: 1%;">Web User</h5>
        </div>
        <div class="row animated fadeInRightBig">

            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            {{-- <span class="label label-success float-right"></span> --}}
                        </div>
                        <h5>Forex Users</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $web_forex_users }}</h1>
                        {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                        <small>Total</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            {{-- <span class="label label-info float-right">Annual</span> --}}
                        </div>
                        <h5>Crypto Users</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $web_both_users }}</h1>
                        {{-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> --}}
                        <small>Total</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            {{-- <span class="label label-primary float-right">Today</span> --}}
                        </div>
                        <h5>Both (Forex & Crypto) Users</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $web_both_users }}</h1>
                        {{-- <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div> --}}
                        <small>Total</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
