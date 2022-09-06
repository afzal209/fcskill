@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Signals</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('predictions') }}">Prediction Ideas</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Update Prediction Ideas</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('predictions') }}" class="btn btn-primary">Back to Prediction Ideas</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Update Prediction Ideas</h5>
                    </div>
                    <div class="ibox-content">


                        <form method="post" action="{{ route('predictions_update', $predictionideas->id) }}"
                            class="p-3">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label> Prediction Ideas </label>
                                <textarea class="form-control" id="prediction_text" name="prediction_text">{{ $predictionideas->prediction_text }}</textarea>
                            </div>

                            <div class="form-row ">
                                <div class="form-group col-md-12">
                                    <label for="signal_type">Prediction Ideas Type <span
                                            class="text-danger">*</span></label>
                                    <div class="i-checks">

                                        <label>
                                            <input type="radio" value="1"
                                                @if ($predictionideas->prediction_type == 1) checked="" @endif name="prediction_type">
                                            <i></i> Forex Prediction Ideas
                                        </label>
                                    </div>
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" value="0"
                                                @if ($predictionideas->prediction_type == 0) checked="" @endif name="prediction_type">
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
                                                    @if ($predictionideas->status == 0) checked="" @endif>
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
