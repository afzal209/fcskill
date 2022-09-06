@extends('layouts.web_master')
@section('title', 'Fundamental Analysis')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col fundamental">


            </div>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col"><img src="{{ asset('images/blog1.png') }}" width="100%" height="auto"></div>
            <div class="col"></div>
        </div><br>
    </div> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var forex = '';
        $.ajax({
            url: "/api/fundamental_analysis",
            type: "GET",
            success: function(data) {
                // console.log(data);
                $.each(data, function(key, value) {
                    // console.log(value);
                    $('.fundamental').append(value);
                    $('.fundamental').find('img').addClass("img-fluid")
                });
            }
        })
    </script>
@endsection
