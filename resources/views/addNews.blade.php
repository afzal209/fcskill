@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>News</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('news') }}">News</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>New News</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('news') }}" class="btn btn-primary">Back to News</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Add New</h5>
                    </div>
                    <div class="ibox-content">


                        <form method="post" action="{{ route('store_news') }}" class="p-3">
                            @csrf


                            <input type="hidden" name="analysis_type" value="technical">

                            <div class="form-group">
                                <label>News Feed </label>
                                <textarea class="form-control" id="news_text" placeholder="Enter Forex Technical Analysis" name="news_text"></textarea>
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
