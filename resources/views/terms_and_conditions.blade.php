@extends('layouts.app')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Privacy Policy & Terms and Conditions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('terms_and_conditions') }}">Terms And Conditions</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Terms And Conditions</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Update Terms And Conditions</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('terms_and_conditions_update') }}" class="p-3">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label> Terms And Conditions </label>
                                <textarea class="form-control" id="terms_and_conditions" placeholder="Enter Terms And Conditions"
                                    name="terms_and_conditions">{{ $data->meta_value }}</textarea>
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