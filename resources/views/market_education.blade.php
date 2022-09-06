@extends('layouts.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('market_education') }}">Market Education</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Market Education (Technical & Fundamental Analysis)</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Update Technical & Fundamental Analysis</h5>
                </div>
                <div class="ibox-content">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist">
                            <li><a class="nav-link active" data-toggle="tab" href="#technical_analysis_tab"> Technical Analysis</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#fundamental_analysis_tab">Fundamental Analysis</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" id="technical_analysis_tab" class="tab-pane active">
                                <div class="panel-body">

                                    <form method="post" action="{{ route('market_education_update') }}" class="p-3">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="analysis_type" value="technical">

                                        <div class="form-group">
                                            <label>Technical Analysis </label>
                                            <textarea class="form-control" id="technical_analysis" placeholder="Enter Forex Technical Analysis" name="technical_analysis">{{ $data->technical_analysis }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary mb-1">
                                            <i class="fa fa-save"></i>
                                            Submit
                                        </button>

                                    </form>

                                </div>
                            </div>
                            <div role="tabpanel" id="fundamental_analysis_tab" class="tab-pane">
                                <div class="panel-body">

                                    <form method="post" action="{{ route('market_education_update') }}" class="p-3" enctype="multipart/form-data">

                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="analysis_type" value="fundamental">

                                        <div class="form-group">
                                            <label> Fundamental Analysis </label>
                                            <textarea class="form-control" id="fundamental_analysis" placeholder="Enter Crypto Technical Analysis" name="fundamental_analysis">{{ $data->fundamental_analysis }}</textarea>
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