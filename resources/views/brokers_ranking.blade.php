@extends('layouts.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Brokers Ranking</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>List of Brokers Ranking</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Update Brokers Ranking</h5>
                </div>
                <div class="ibox-content">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist">
                            <li><a class="nav-link active" data-toggle="tab" href="#forex_brokers_ranking_tab">Forex Brokers Ranking</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#crypto_brokers_ranking_tab">Crypto Brokers Ranking</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" id="forex_brokers_ranking_tab" class="tab-pane active">
                                <div class="panel-body">

                                    <form method="post" action="{{ route('brokers_ranking_update') }}" class="p-3">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="ranking_type" value="forex">

                                        <div class="form-group">
                                            <label>Forex Brokers Ranking </label>
                                            <textarea class="form-control" id="forex_brokers_ranking" placeholder="Enter Forex Brokers Ranking" name="forex_brokers_ranking">{{ $forex_ranking->meta_value }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary mb-1">
                                            <i class="fa fa-save"></i>
                                            Submit
                                        </button>

                                    </form>

                                </div>
                            </div>
                            <div role="tabpanel" id="crypto_brokers_ranking_tab" class="tab-pane">
                                <div class="panel-body">

                                    <form method="post" action="{{ route('brokers_ranking_update') }}" class="p-3" enctype="multipart/form-data">

                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="ranking_type" value="crypto">

                                        <div class="form-group">
                                            <label> Crypto Brokers Ranking </label>
                                            <textarea class="form-control" id="crypto_brokers_ranking" placeholder="Enter Crypto Brokers Ranking" name="crypto_brokers_ranking">{{ $crypto_ranking->meta_value }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary mb-1">
                                            <i class="fa fa-save"></i>
                                            Submit
                                        </button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection