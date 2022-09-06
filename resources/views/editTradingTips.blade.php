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
                    <strong>Update Trading Tips</strong>
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
                        <h5>Update Trading Tips</h5>
                    </div>
                    <div class="ibox-content">


                        <form method="post" action="{{ route('tradings_update', $tradingtips->id) }}" class="p-3">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label> Trading Tips </label>
                                <textarea class="form-control" id="trading_text" name="trading_text">{{ $tradingtips->trading_text }}</textarea>
                            </div>

                            <div class="form-row ">
                                <div class="form-group col-md-12">
                                    <label for="signal_type">Trading Tips Type <span class="text-danger">*</span></label>
                                    <div class="i-checks">

                                        <label>
                                            <input type="radio" value="1"
                                                @if ($tradingtips->trading_type == 1) checked="" @endif name="trading_type">
                                            <i></i> Forex Prediction Ideas
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="0"
                                                @if ($tradingtips->trading_type == 0) checked="" @endif name="trading_type">
                                            <i></i> Crypto Prediction Ideas
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row ">
                                <div class="form-group col-md-12">
                                    <label for="status">Status</label>
                                    <div class="i-checks">

                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="status" value="1"
                                                    @if ($tradingtips->status == 0) checked="" @endif>
                                                <i></i> Inactive
                                            </label>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-save"></i>
                                SAVE</button>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
