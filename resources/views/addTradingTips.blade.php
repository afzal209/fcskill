@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Trading Tips</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('tradings') }}">Trading Tips</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>New Trading Tips</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('tradings') }}" class="btn btn-primary">Back to Trading Tips</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Add Trading Tips</h5>
                    </div>
                    <div class="ibox-content">


                        <form method="post" action="{{ route('store_tradings') }}" class="p-3">
                            @csrf




                            <div class="form-group">
                                <label>Trading Tips </label>
                                <textarea class="form-control" id="trading_text" placeholder="Enter Trading Tips" name="trading_text"></textarea>
                            </div>
                            <div class="form-row ">
                                <div class="form-group col-md-12">
                                    <label for="signal_type">Trading Tips Type <span class="text-danger">*</span></label>
                                    <div class="i-checks">

                                        <label>
                                            <input type="radio" value="1" checked="" name="trading_type">
                                            <i></i> Forex Trading Tips
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="0" name="trading_type">
                                            <i></i> Crypto Trading Tips
                                        </label>
                                    </div>
                                </div>
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
@endsection
