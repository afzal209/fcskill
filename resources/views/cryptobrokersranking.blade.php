@extends('layouts.web_master')
@section('title', 'Crypto Brokers Ranking')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col crypto">

            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var forex = '';
        $.ajax({
            url: "/api/crypto_brokers_ranking",
            type: "GET",
            success: function(data) {
                // console.log(data);
                $.each(data, function(key, value) {
                    // console.log(value);
                    $('.crypto').append(value);
                    $('.crypto').find('img').addClass("img-fluid")
                });
            }
        })
    </script>
@endsection
