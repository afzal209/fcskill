@extends('layouts.web_master')
@section('title', 'Forex Brokers Ranking')
@section('content')
    {{-- <section>
        <div class="container-fluid" style="background-image: linear-gradient(to right, #f87b1c,  rgba(255,249,203,168));">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <ul style="list-style: none">
                            <li class="fs-5">
                                <p class="fs-5 mt-5"><strong>XM Broker</strong></p>
                                <img src="images/blog2.png" class="img-fluid" width="300" height="auto">
                                <p class="fs-6 mt-3">
                                <ul style="list-style: none">
                                    <li>
                                        <p class="fs-6">This Privacy Policy describes how FCskill treats personal
                                            information that FCskill collects when you use FCskill Services.</p>
                                    </li>
                                    <li>
                                        <p class="fs-6">This Privacy Policy describes how FCskill treats personal
                                            information that FCskill collects when you use FCskill Services.</p>
                                    </li>
                                    <li>
                                        <p class="fs-6">This Privacy Policy describes how FCskill treats personal
                                            information that FCskill collects when you use FCskill Services.</p>
                                    </li>
                                    <li>
                                        <p class="fs-3"><b>This Privacy Policy describes how FCskill treats personal
                                                information that FCskill collects when you use FCskill Services.</b></p>
                                    </li>
                                </ul>
                                </p>
                                <p class="fs-6 mt-3"><a href="#">Click Here</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <div class="container">
        <div class="row">
            <div class="col forex">

            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var forex = '';
        var split = '';
        var img = '';
        var srcImage = '';
        $.ajax({
            url: "/api/forex_brokers_ranking",
            type: "GET",
            success: function(data) {
                // console.log(data);
                $.each(data, function(key, value) {
                    $('.forex').append(value);
                    // console.log($('.forex').find('ul').css("list-style", "none"));
                    $('.forex').find('img').addClass("img-fluid")
                    // console.log(value.split(/\r\n|\r|\n/));
                    // split = value.split(/\r\n|\r|\n/);
                    // console.log(split);
                    // img = split[0].replace(/<\/?p>/g, '');
                    // srcImage = img.split('src=')[1].split(/[ >]/)[0].replace(/"/g, '');
                    // console.log(srcImage);

                });
            }
        })
    </script>
@endsection
