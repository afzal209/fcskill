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
                <a href="https://play.google.com/store/apps/details?id=com.fcskillapp.fcSkill" target="__blank"><img
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
                <p class="fs-5 lh-sm"><br><strong>Forex and Crypto Trading with an Edge</strong></p>
                <p class="fs-6 lh-sm">Trading is hard, but with FCskill, it becomes easier to grow your trading skill.
                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Updates for Forex & Crypto
                        <br></strong></p>
                <p class="fs-6 lh-sm">We will share the latest information about Coins Pump & Dump, Airdrops, Regular market updates, New Promotions, Financial market Impact, Fundmanetal information, Market trend, Coins and what coins should keep for a good profit in the future and much more information you can get for becoming a profitable professional trader.

                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Vip Signals for Forex & Crypto Trading users
                        <br></strong></p>
                <p class="fs-6 lh-sm">Free Daily VIP Forex & Crypto Trading Signals for growing your trading account.
                    <br>
                <p class="fs-5 lh-sm"><strong>Gains / Profit
                        <br></strong></p>
                <p class="fs-6 lh-sm">For Motivation, if you are getting profit from our service, share screenshots and images of your profit to keep motivating other users.

                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Prediction Ideas for Forex & Crypto Trading
                        <br></strong></p>
                <p class="fs-6 lh-sm">Our top professional market analysts provide the best Forex & Crypto trading market Prediction and ideas in which you can get market predictions and ideas of different pairs ideas for good trading results. Through our prediction/ideas, you can take the idea of the market that in the next few minutes, hours, weeks, and months, what will be the movement of the market and what will be perfect support and resistance so you can get good profit.

                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Brokers Ranking
                        <br></strong></p>
                <p class="fs-6 lh-sm">Information about overall Best brokers, Most trusted, Excellent all-round offering. Create account, Deposit/Withdrawal information. New promotions, Cashback offers and many more.
                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>News Calendar for Forex & Crypto
                        <br></strong></p>
                <p class="fs-6 lh-sm">The economic news calendar is a tool that investors use to monitor market-moving events, such as economic indicators and monetary policy decisions. Market moving events, which are typically announced or released in a report, have a high probability of impacting the financial markets. News Impact ( High, Medium, Low )
                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Technical & Fundamental Analysis / Training for Forex & Crypto User’s
                        <br></strong></p>
                <p class="fs-6 lh-sm">Become a professional Trader. FCskill provides Training / Education from Beginner to Advance levels of Trading if you want to become a Professional Trader, so you should learn about Technical & Fundamental Analysis in which Candlesticks, information about Candles and how you can take the idea of Entry from Support & Resistance, Trend line, Chart patterns, heads & shoulder patters, Double top, Double bottom, Triangle pattern, FOMC News, CPI, PPI, ISM, NFP, Central banks, FED news, ECB, BOE and much other information about Technical and Fundaments Analysis
                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Trading Session
                        <br></strong></p>
                <p class="fs-6 lh-sm">The ability to trade over 24 hours is due in part to different international time zones. It also helps traders to get the best opportunity to trade in different international time zones.

                    <br>
                </p>
                <p class="fs-5 lh-sm"><strong>Share FCskill App
                        <br></strong></p>
                <p class="fs-6 lh-sm">Share fcskill App with friends, groups and on social media accounts. You can help for growing their trading account by sharing this App.

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
