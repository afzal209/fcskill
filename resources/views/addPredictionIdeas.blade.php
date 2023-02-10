@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Prediction Ideas</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('predictions') }}">Prediction Ideas</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>New Predication Ideas</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('predictions') }}" class="btn btn-primary">Back to Prediction</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Add Prediction Ideas</h5>
                    </div>
                    <div class="ibox-content">


                        <form method="post" action="{{ route('store_predictions') }}" class="p-3">
                            @csrf

                            <div class="form-group">
                                <label> Prediction Ideas </label>
                                <textarea class="form-control" id="prediction_text" name="prediction_text"></textarea>
                            </div>

                            <div class="form-row ">
                                <div class="form-group col-md-12">
                                    <label for="signal_type">Prediction Ideas Type <span
                                            class="text-danger">*</span></label>
                                            @if(auth()->user()->id != 2)
                                                @if(auth()->user()->signal_type == 0)   
                                                <div class="i-checks">
            
                                                    <label>
                                                        <input type="radio" value="0" checked="" name="prediction_type">
                                                        <i></i> Forex Prediction Ideas
                                                    </label>
                                                </div>
                                                @elseif(auth()->user()->signal_type == 1)
                                                <div class="i-checks">
            
                                                    <label>
                                                        <input type="radio" value="1" checked="" name="prediction_type">
                                                        <i></i> Forex Prediction Ideas
                                                    </label>
                                                </div>
                                                @else
                                                <div class="i-checks">
            
                                                    <label>
                                                        <input type="radio" value="1" checked="" name="prediction_type">
                                                        <i></i> Forex Prediction Ideas
                                                    </label>
                                                </div>
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="radio" value="0" name="prediction_type">
                                                        <i></i> Crypto Prediction Ideas
                                                    </label>
                                                </div>
                                                @endif
                                            @else
                                            <div class="i-checks">
            
                                                    <label>
                                                        <input type="radio" value="1" checked="" name="prediction_type">
                                                        <i></i> Forex Prediction Ideas
                                                    </label>
                                            </div>
                                            <div class="i-checks">
                                                <label>
                                                    <input type="radio" value="0" name="prediction_type">
                                                    <i></i> Crypto Prediction Ideas
                                                </label>
                                            </div>
                                            @endif
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
