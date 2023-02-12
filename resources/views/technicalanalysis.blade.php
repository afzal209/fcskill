@extends('layouts.web_master')
@section('title', 'Technical Analysis')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 technical">

            </div>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row">
            <div class="col-12"></div>
            <div class="col-12"><img src="{{ asset('images/blog1.png') }}" class = "img-fluid" width="100%" height="auto"></div>
            <div class="col-12"></div>
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
