@extends('layouts.web_master')
@section('title', 'News Calander')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col mt-4"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <h1>
                    <p class="text-center lh-1" style="color:white">News Calendar</p>
                </h1><br>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
            <div class="col-12 col-sm-12 col-md-10 col-lg-10">
                <!--  ========================================= -->
                <div id="tradingview_8108d-wrapper"
                    style="position: relative;box-sizing: content-box;width: 100%;height: auto; margin: 0 auto !important;padding: 0 !important;font-family: -apple-system, BlinkMacSystemFont, 'Trebuchet MS', Roboto, Ubuntu, sans-serif;"
                    <div style="width: 100%;height: auto; background: transparent;padding: 0 !important;">

                    <div id="economic-calendar-366411">
                        <script type="text/javascript" src="https://www.cashbackforex.com/Content/remote/remote-calendar-widget.js"></script>
                        <script type="text/javascript">
                            RemoteCalendar({
                                "DefaultTime": "today",
                                "DefaultTheme": "dark",
                                "Url": "https://www.cashbackforex.com",
                                "SubPath": "economic-calendar",
                                "IsShowEmbedButton": false,
                                "ContainerId": "economic-calendar-366411"
                            });
                        </script>
                    </div>
                </div>
            </div>
            <!--  ========================================= -->
        </div>
        <br>
        <div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
    </div>
    </div>

@endsection
