@extends('layouts.web_master')
@section('title', 'Forex Brokers Ranking')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 forex">

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var forex = '';
        $.ajax({
            url: "/api/forex_brokers_ranking",
            type: "GET",
            success: function(data) {
                // console.log(data);
                $.each(data, function(key, value) {
                    // console.log(value);
                    $('.forex').append(value);
                    // console.log($('.forex').find('ul').css("list-style", "none"));
                    $('.forex').find('img').addClass("img-fluid")
                });
            }
        })
    </script>
@endsection
