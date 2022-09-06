@extends('layouts.web_master')
@section('title', 'Chart')
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
                    <p class="text-center lh-1" style="color:white">Live Market Chart</p>
                </h1><br>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div id="tradingview_b4dcc">
                    <div id="tradingview_8108d-wrapper"
                        style="position: relative;box-sizing: content-box;width: 100%;height: calc(630px - 32px);margin: 0 auto !important;padding: 0 !important;font-family: -apple-system, BlinkMacSystemFont, 'Trebuchet MS', Roboto, Ubuntu, sans-serif;">
                        <div style="width: 100%;height: calc(630px - 32px);background: transparent;padding: 0 !important;">
                            <iframe id="tradingview_8108d"
                                src="https://s.tradingview.com/widgetembed/?frameElementId=tradingview_8108d&amp;symbol=GOLD&amp;interval=D&amp;hidesidetoolbar=0&amp;symboledit=1&amp;saveimage=1&amp;toolbarbg=f1f3f6&amp;studies=%5B%5D&amp;hideideas=1&amp;theme=dark&amp;style=1&amp;timezone=Etc%2FUTC&amp;withdateranges=1&amp;showpopupbutton=0&amp;studies_overrides=%7B%7D&amp;overrides=%7B%7D&amp;enabled_features=%5B%5D&amp;disabled_features=%5B%5D&amp;showpopupbutton=1&amp;locale=en&amp;utm_source=www.fcskill.com&amp;utm_medium=widget_new&amp;utm_campaign=chart&amp;utm_term=GOLD"
                                style="width: 100%; height: 100%; margin: 0 !important; padding: 0 !important;"
                                frameborder="0" allowtransparency="true" scrolling="no" allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-1"></div>
        </div>
        <br><br>
    </div>

@endsection
