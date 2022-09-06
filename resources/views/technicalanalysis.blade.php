@extends('layouts.web_master')
@section('title', 'Technical Analysis')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col technical">

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
            url: "/api/technical_analysis",
            type: "GET",
            success: function(data) {
                // console.log(data);
                $.each(data, function(key, value) {
                    // console.log(value);
                    $('.technical').append(value);
                    $('.technical').find('img').css({
                        "width": "100%",
                        "height": "auto"
                    })
                });
            }
        })
    </script>
@endsection
