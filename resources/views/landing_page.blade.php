@extends('layouts.web_master')
@section('title', 'Home')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                <p class="fs-2" style="color:white"><strong>Forex and Crypto Trading
                        With an Edge</strong></p>
                <p class="fs-5">Trading is hard but with FCskill it becomes easier
                    for growing your trading skill.
                    Take advantage of our Forex and Crypto trading skill and <strong>Install
                        this Android App,</strong> which is used by Professional
                    Traders.</p>
                <a href="https://play.google.com/store/apps/details?id=com.fcskillapp.fcSkill"><img
                        src="{{ asset('images/google_badge.png') }}" class="ml-n1 img-fluid" alt="..." height="auto"></a>
                <br><br>
                <p class="fs-4">
                    <font class="whi"><strong>For Daily</strong> </font>
                    <font class="bla"><strong> VIP (</strong></font>
                    <font class="whi"><strong>Forex
                        </strong></font>
                    <font class="bla"><strong> & </strong></font>
                    <font class="whi"><strong>Crypto Trading</strong></font>
                    <font class="bla"><strong> ) </strong></font>
                    <font class="whi"><strong>Signals
                        </strong></font>
                    <font class="bla"><strong>for growing your
                            trading account </strong></font>
                </p>
                <button type="button" class="ml-3 btn btn-lg btn-reg"
                    style="background-color: black; color: aliceblue;border-radius:
              0%;">Free
                    Register</button>
                <p class="fs-5 lh-sm"><br><strong>Forex and Crypto Trading with an
                        Edge</strong></p>
                <p class="fs-6 lh-sm">Trading is hard but with FCskill it becomes
                    easier for growing your trading skill.
                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Forex & Crypto Trading Signals
                        <br></strong></p>
                <p class="fs-6 lh-sm">Daily VIP Signals for growing your trading
                    account
                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Live Market Chart
                        <br></strong></p>
                <p class="fs-6 lh-sm">Market price movement, to identify trends, and
                    to anticipate market reversals from bullish trends to bearish
                    trends and bearish trends to bullish. Best and Popular trading
                    indicators, all pairs, And a lot more...
                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>News Calendar
                        <br></strong></p>
                <p class="fs-6 lh-sm">The economic news calendar is a tool that
                    investors use to monitor market-moving events, such as economic
                    indicators and monetary policy decisions. Market moving events,
                    which are typically announced or released in a report, have a high
                    probability of impacting the financial markets. News Impact (
                    Hight, Medium, Low )
                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Technical & Fundamental Analysis /
                        Training
                        <br></strong></p>
                <p class="fs-6 lh-sm">Become professional Trader. FCskill is
                    providing Training / Education from Beginner to Advance level of
                    Trading. If you want to become a Professional Trader so you should
                    learn about Technical & Fundamental Analysis.
                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Trading Session
                        <br></strong></p>
                <p class="fs-6 lh-sm">The ability to trade over a 24-hour period is
                    due in part to different international time zones. It also helps
                    traders to get the best opportunity to trade in different
                    international time zones.
                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Brokers Ranking
                        <br></strong></p>
                <p class="fs-6 lh-sm">Best overall brokers, Most trusted, Excellent
                    all-round offering.
                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Share This App
                        <br></strong></p>
                <p class="fs-6 lh-sm">Share this app with friends, groups and on
                    social media accounts. You can help for growing their trading
                    account with share this App.
                    <br>
                </p>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 mt-5 ">
                <a href="javascript:void(0);" class="reload"><img src="{{ asset('images/Untitled-design(14).png') }}"
                        class="responsive
              image-fluid"></a>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            var click = localStorage.getItem('click')
            if (click != null) {
                $('#exampleModal').modal('show');
                localStorage.removeItem('click');
            }
            $('.btn-reg').click(function() {
                // alert();
                $('#exampleModal1').modal('show');
            })

            $('.reload').on('click', function() {
                // alert();
                location.reload();
            })
        })
    </script>
@endsection
