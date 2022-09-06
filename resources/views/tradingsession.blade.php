@extends('layouts.web_master')
@section('title', 'Trading Session')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col mt-4">
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <h1>
                    <p class="text-center lh-1" style="color:white">Trading Session</p>
                </h1>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row" style="
    margin-top: 10px;
">
            <div class="col-2"></div>
            <div class="col-8">
                <h2>
                    <p class="text-center lh-1 mt-n2"><strong>GMT & UTC Time Zone</strong></p>
                </h2>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <p class="text-center lh-1 mt-n2">
                    <font style="font-size: medium; font-weight: 450;">The ability to trade over a 24-hour period is due in
                        part to different international time zones. </font>
                </p>
                <p class="text-center lh-1 mt-n2">
                    <font style="font-size: medium; font-weight: 450;"> It also helps traders to get the best opportunity to
                        trade in different international time zones.</font>
                </p>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <p class="text-center lh-1 mt-n2"><strong>4 major trading sessions with opening/closing hours of market
                        session</strong></p>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col col-sm-12 col-md-2 col-lg-2"></div>
            <div class="col col-sm-12 col-md-8 col-lg-8">
                <table class="table table-sm">
                    <thead class="thead table-dark">
                        <tr>
                            <th scope="col" style="text-align: center">Time Zone</th>
                            <th scope="col" style="text-align: center">Session Opening Time</th>
                            <th scope="col" style="text-align: center">Session Closing Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" style="text-align: center">London, Europe</th>
                            <td style="text-align: center">07:00 AM</td>
                            <td style="text-align: center">03:00 PM</td>
                        </tr>
                        <tr>
                            <th scope="row" style="text-align: center">New York, USA</th>
                            <td style="text-align: center">12:00 PM</td>
                            <td style="text-align: center">08:00 PM</td>
                        </tr>
                        <tr>
                            <th scope="row" style="text-align: center">Sydney, Austrailia</th>
                            <td style="text-align: center">10:00 PM</td>
                            <td style="text-align: center">06:00 AM</td>
                        </tr>
                        <tr>
                            <th scope="row" style="text-align: center">Tokyo, Japan, Asia</th>
                            <td style="text-align: center">11:00 PM</td>
                            <td style="text-align: center">07:00 AM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col col-sm-12 col-md-2 col-lg-2"></div>
        </div>
    </div>
    <div class="container-fluid" height="auto">
        <div class="row">
            <div class="col mt-4">
                <p class="text-center lh-1 mt-n2"> <strong style="font-size: 26px">What is a Trading Session?</strong>
                </p>
            </div>
        </div>
        <div class="row" style="
    margin-top: -17px;
">
            <div class="col mt-4">
                <p class="text-center lh-1 mt-n2">
                    <font style="font-size: medium; font-weight: 450;">The trading session is very important for remembering
                        the market's opening and closing time. You can get Best and Profitable trades after remembering
                        trading session. It checks the primary daytime trading hours for a given locale.
                    </font>
                </p>
                <p class="text-center lh-1 mt-n2">
                    <font style="font-size: medium; font-weight: 450;">This phrase will guide to different hours, depending
                        on the discussed markets and locations.
                        Generally, a single day
                        of trade in the local financial market, is the trading session the individual investor or trader
                        will reference.</font>
                </p>
                <p class="text-center lh-1 mt-n2">
                    <font style="font-size: medium; font-weight: 450;">The markets for forex, Crypto, futures, and stocks
                        all have different features that specify their respective trading sessions for a given day. The
                        trading hours are naturally different from country to country due to contrasting time zones.</font>
                </p>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col mt-4">

            </div>
        </div> --}}
        <div class="row">
            <div class="col mt-4">
                <p class="text-center lh-1 mt-n2"> <strong style="font-size: 26px">Which session is good for trading?
                    </strong>
                </p>
            </div>
        </div>
        <div class="row" style="
    margin-top: -17px;
">
            <div class="col mt-4">
                <p class="text-center lh-1 mt-n2">
                    <font style="font-size: medium; font-weight: 450;">The most suitable time for trading is when the market
                        is most active. When more than one of the four markets are open simultaneously, there will be a best
                        trading time, which means there will be more important fluctuation in currency pairs.
                    </font>
                </p>
            </div>
        </div>
    </div>

@endsection
