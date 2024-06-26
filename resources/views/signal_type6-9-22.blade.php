@extends('layouts.web_master')
@section('title', 'Signal')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-2 col-lg-2"></div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
            <h1>
                <p class="text-center lh-1 signal_lh-1" style="color:white"></p>
            </h1><br>
        </div>
        <div class="col-12 col-sm-12 col-md-2 col-lg-2"></div>
    </div>
    <div class="signal_data">

    </div>
    {{-- <div class="row"> --}}
    {{-- <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-4">
            <div class="card bg-light card-rad">
                <div class="card-body">
                    <p class="fs-6 lh-1 text-center"><strong>Gold Buy 1705 - 1707</strong></p>
                    <p class="fs-6 lh-2 text-center">TpO- 1710<br>Tp-1- 1712<br>Tp-2- 1715</p>
                    <p class="fs-6 lh-1 text-center">Sl 1690</p>
                    <p class="text-center fs-6 lh-1 text-center mb-n3">2022-06-03 11:49</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div> --}}
    {{-- </div><br> --}}


    {{-- <div class="row">
        <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-4">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" id="page_1" onclick="Paginate(1)" href="#">1</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>
    </div> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.2/socket.io.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
    <script>
        var getToken = localStorage.getItem('token');
        // console.log(getToken);
        if (!getToken) {
            window.location.href = '/'
            localStorage.setItem('click', 'true');
        } else {
            var getUser = localStorage.getItem('user_data');
            var json_parse = JSON.parse(getUser);
            var signal_type = json_parse.signal_type;
            let socket = '';
            let ip_address = '127.0.0.1';
            let socket_port = '3004';
            socket = io(ip_address + ':' + socket_port);
            // console.log(socket);
            socket.on('receivedSignalData', (message) => {
                // console.log(message);
                $('.signal_data').empty();
                var current_page = '';
                var last_page = '';
                var first_page_url = '';
                var last_page_url = '';
                var per_page = '';
                var total = '';

                $.ajax({
                    url: '/api/signal_check/' + message,
                    headers: {
                        'Authorization': 'Bearer ' + getToken
                    },
                    type: 'GET',

                    success: function(data) {
                        console.log(data);
                        current_page = data.data.current_page;
                        // console.log(current_page);
                        last_page = data.data.last_page;
                        signal_data_array = data.data.data;
                        first_page_url = data.data.first_page_url;
                        last_page_url = data.data.last_page_url
                        per_page = data.data.per_page;
                        total = data.data.total;
                        total_page = Math.ceil(total / per_page);
                        console.log(total_page);
                        for (var i = 0; i < signal_data_array.length; i++) {
                            // console.log(signal_data_array[i]);
                            $('.signal_data').append(
                                '<div class="row"><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div><div class="col-12 col-sm-12 col-md-8 col-lg-4"><div class="card bg-light card-rad"><div class="card-body"> <p class="fs-6 lh-1 text-center"><strong>' +
                                signal_data_array[i]['signal_text'] +
                                '</strong></p> <p class="text-center fs-6 lh-1 text-center mb-n3">' +
                                signal_data_array[i]['created_at'] +
                                '</p></div></div></div><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div></div><br>'
                            );
                        }

                        //Create dynamic pages
                        // var paginateButtons =
                        //     '<div class="row">' +
                        //     '    <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>' +
                        //     '    <div class="col-12 col-sm-12 col-md-8 col-lg-4">' +
                        //     '        <nav aria-label="Page navigation example">' +
                        //     '            <ul class="pagination justify-content-center">' +
                        //     '                <li class="page-item page-item-disable  disable">' +
                        //     '                    <button id="btnPrev" class="page-link" data-btn="prev" onclick="prv_page(' +
                        //     signal_type +
                        //     ');" tabindex="-1" disabled>Previous</button>' +
                        //     '                </li>';
                        // for (var i = 1; i <= last_page; i++) {
                        //     paginateButtons +=
                        //         '<li class="page-item"><a class="page-link paginate' + (i == 1 ?
                        //             " active-page " : "") + '" id="page_' +
                        //         i + '" onclick="Paginate(' + i + ',' + signal_type +
                        //         ')" href="#" >' +
                        //         i +
                        //         '</a>' +
                        //         '                </li>'
                        // };

                        // paginateButtons += '<li class="page-item">' +
                        //     '                    <button id="btnNext" class="page-link" data-btn="next"   >Next</button>' +
                        //     '                </li>' +
                        //     '            </ul>' +
                        //     '        </nav>' +
                        //     '    </div>' +
                        //     '    <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>' +
                        //     '</div>';
                        // // console.log(paginateButtons);
                        // $('.signal_data').after(paginateButtons);
                        // $.each(data.data, function(key, value) {
                        // console.log(value);
                        // $('#signal_data').html(value.signal_text);
                        // socket.emit('receivedSignalData', value);

                        // $('.signal_data').append(
                        //     '<div class="row"><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div><div class="col-12 col-sm-12 col-md-8 col-lg-4"><div class="card bg-light card-rad"><div class="card-body"> <p class="fs-6 lh-1 text-center"><strong>' +
                        //     value.signal_text +
                        //     '</strong></p> <p class="text-center fs-6 lh-1 text-center mb-n3">' +
                        //     value.created_at +
                        //     '</p></div></div></div><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div></div><br>'
                        // );
                        // })
                        // $('#signal_data').html(data);
                    }
                });
            });
        }
        var selectedPageNo = 0;
        $(document).ready(function() {

            // if (!getToken) {
            //     window.location.href = '/'
            //     localStorage.setItem('click', 'true');
            // }

            var getToken = localStorage.getItem('token');
            var getUser = localStorage.getItem('user_data');
            var json_parse = JSON.parse(getUser);
            var signal_type = json_parse.signal_type;
            if (signal_type == 0) {
                $('.signal_lh-1').append('Crypto Signal')
            } else if (signal_type == 1) {
                $('.signal_lh-1').append('Forex Signal')
            } else {
                $('.signal_lh-1').append('Forex & Crypto Signals')

            }
            // var data = $('<div></div>');
            // console.log(signal_type);
            var signal_data_array = '';
            var current_page = '';
            var last_page = '';
            var first_page_url = '';
            var last_page_url = '';
            var per_page = '';
            var total = '';

            $.ajax({
                url: '/api/signal_check/' + signal_type,
                headers: {
                    'Authorization': 'Bearer ' + getToken
                },
                type: 'GET',

                success: function(data) {
                    console.log(data);
                    current_page = data.data.current_page;
                    // console.log(current_page);
                    last_page = data.data.last_page;
                    signal_data_array = data.data.data;
                    first_page_url = data.data.first_page_url;
                    last_page_url = data.data.last_page_url
                    per_page = data.data.per_page;
                    total = data.data.total;
                    total_page = Math.ceil(total / per_page);
                    // console.log(total_page);
                    for (var i = 0; i < signal_data_array.length; i++) {
                        console.log(signal_data_array[i]);
                        $('.signal_data').append(
                            '<div class="row"><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div><div class="col-12 col-sm-12 col-md-8 col-lg-4"><div class="card bg-light card-rad"><div class="card-body"> <p class="fs-6 lh-1 text-center"><strong>' +
                            signal_data_array[i]['signal_text'] +
                            '</strong></p> <p class="text-center fs-6 lh-1 text-center mb-n3">' +
                            signal_data_array[i]['created_at'] +
                            '</p></div></div></div><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div></div><br>'
                        );
                    }

                    //Create dynamic pages
                    var paginateButtons =
                        '<div class="row">' +
                        '    <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>' +
                        '    <div class="col-12 col-sm-12 col-md-8 col-lg-4">' +
                        '        <nav aria-label="Page navigation example">' +
                        '            <ul class="pagination justify-content-center">' +
                        '                <li class="page-item page-item-disable  disable">' +
                        '                    <button id="btnPrev" class="page-link" data-btn="prev" onclick="prv_page(' +
                        signal_type +
                        ');" tabindex="-1" disabled>Previous</button>' +
                        '                </li>';
                    for (var i = 1; i <= last_page; i++) {
                        paginateButtons +=
                            '<li class="page-item"><a class="page-link paginate' + (i == 1 ?
                                " active-page " : "") + '" id="page_' +
                            i + '" onclick="Paginate(' + i + ',' + signal_type + ')" href="#" >' +
                            i +
                            '</a>' +
                            '                </li>'
                    };

                    paginateButtons += '<li class="page-item">' +
                        '                    <button id="btnNext" class="page-link" data-btn="next"   >Next</button>' +
                        '                </li>' +
                        '            </ul>' +
                        '        </nav>' +
                        '    </div>' +
                        '    <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>' +
                        '</div>';
                    // console.log(paginateButtons);
                    $('.signal_data').after(paginateButtons);
                    // $.each(data.data, function(key, value) {
                    // console.log(value);
                    // $('#signal_data').html(value.signal_text);
                    // socket.emit('receivedSignalData', value);

                    // $('.signal_data').append(
                    //     '<div class="row"><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div><div class="col-12 col-sm-12 col-md-8 col-lg-4"><div class="card bg-light card-rad"><div class="card-body"> <p class="fs-6 lh-1 text-center"><strong>' +
                    //     value.signal_text +
                    //     '</strong></p> <p class="text-center fs-6 lh-1 text-center mb-n3">' +
                    //     value.created_at +
                    //     '</p></div></div></div><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div></div><br>'
                    // );
                    // })
                    // $('#signal_data').html(data);
                }
            });
            $('body').on('click', '.page-link', function() {
                // alert('yes');
                // console.log(this.id);
                var pageNoP = selectedPageNo;
                if (this.id == 'page_' + pageNoP) {
                    console.log('page');
                } else if (this.id == 'btnPrev') {
                    selectedPageNo = (selectedPageNo - 1) <= 1 ? 1 : selectedPageNo - 1;

                    console.log('Prev');
                } else if (this.id == 'btnNext') {
                    selectedPageNo = (selectedPageNo + 1) >= last_page ? last_page : selectedPageNo + 1;
                    console.log('Next');
                }

                // console.log($('#btnNext').attr('data-btn'));
                // if ($('#btnPrev').attr('data-btn') == 'prev') {
                //     console.log('Prev');
                // } else if ($('#btnNext').attr('data-btn') == 'next') {
                //     console.log('Next');
                // }

                console.log("#page_" + pageNoP);

                // console.log(selectedPageNo);
                $('.paginate').removeClass("active-page");

                $("#page_" + selectedPageNo).addClass('active-page');

                if (selectedPageNo <= 1) {
                    // console.log('yes');
                    $('#btnPrev').attr('disabled', 'disabled');
                } else {
                    $('#btnPrev').removeAttr('disabled');
                }
                // selectedPageNo--;

                // if (pageNoP == 1) {
                //     console.log(pageNoP);
                // }
                // console.log(this.id);
                // $('#' + this.id).addClass('active-page');
                // console.log(this);
                $.ajax({
                    url: '/api/signal_check/' + signal_type + '?page=' + selectedPageNo,
                    headers: {
                        'Authorization': 'Bearer ' + getToken
                    },
                    type: 'GET',

                    success: function(data) {
                        console.log(data);
                        //return;
                        current_page = data.data.current_page;
                        // console.log(current_page);
                        last_page = data.data.last_page;
                        signal_data_array = data.data.data;
                        first_page_url = data.data.first_page_url;
                        last_page_url = data.data.last_page_url
                        per_page = data.data.per_page;
                        total = data.data.total;
                        // total_page = Math.ceil(total / per_page);
                        // console.log(total_page);
                        $('.signal_data').empty();
                        for (var i = 0; i < signal_data_array.length; i++) {
                            // console.log(signal_data_array[i]);
                            $('.signal_data').append(
                                '<div class="row"><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div><div class="col-12 col-sm-12 col-md-8 col-lg-4"><div class="card bg-light card-rad"><div class="card-body"> <p class="fs-6 lh-1 text-center"><strong>' +
                                signal_data_array[i]['signal_text'] +
                                '</strong></p> <p class="text-center fs-6 lh-1 text-center mb-n3">' +
                                signal_data_array[i]['created_at'] +
                                '</p></div></div></div><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div></div><br>'
                            );
                        }

                    }
                });

            });

        });

        function Paginate(pageNo, type) {
            // console.log('#page_' + pageNo);
            $('.paginate').removeClass("active-page");
            $("#page_" + pageNo).addClass('active-page');

            selectedPageNo = pageNo;
            $.ajax({
                url: '/api/signal_check/' + type + '?page=' + pageNo,
                headers: {
                    'Authorization': 'Bearer ' + getToken
                },
                type: 'GET',

                success: function(data) {
                    console.log(data);
                    //return;
                    current_page = data.data.current_page;
                    // console.log(current_page);
                    last_page = data.data.last_page;
                    signal_data_array = data.data.data;
                    first_page_url = data.data.first_page_url;
                    last_page_url = data.data.last_page_url
                    per_page = data.data.per_page;
                    total = data.data.total;
                    // total_page = Math.ceil(total / per_page);
                    // console.log(total_page);
                    $('.signal_data').empty();

                    for (var i = 0; i < signal_data_array.length; i++) {
                        // console.log(signal_data_array[i]);
                        $('.signal_data').append(
                            '<div class="row"><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div><div class="col-12 col-sm-12 col-md-8 col-lg-4"><div class="card bg-light card-rad"><div class="card-body"> <p class="fs-6 lh-1 text-center"><strong>' +
                            signal_data_array[i]['signal_text'] +
                            '</strong></p> <p class="text-center fs-6 lh-1 text-center mb-n3">' +
                            signal_data_array[i]['created_at'] +
                            '</p></div></div></div><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div></div><br>'
                        );
                    }

                }
            });
        }

        function prv_page(type) {
            console.log(type);
            // var pageNoMin = selectedPageNo;
            // console.log(pageNoMin);
            // if (selectedPageNo <= 0) {
            //     // console.log('yes');
            //     $('#btnPrev').attr('disabled', 'disabled');
            // } else {
            //     $('#btnPrev').removeAttr('disabled');
            // }
            // $.ajax({
            //     url: 'http://' + window.location.hostname +
            //         ':8000/api/signal_check/' + type + '?page=' + pageNo,
            //     headers: {
            //         'Authorization': 'Bearer ' + getToken
            //     },
            //     type: 'GET',

            //     success: function(data) {
            //         console.log(data);
            //         //return;
            //         current_page = data.data.current_page;
            //         // console.log(current_page);
            //         last_page = data.data.last_page;
            //         signal_data_array = data.data.data;
            //         first_page_url = data.data.first_page_url;
            //         last_page_url = data.data.last_page_url
            //         per_page = data.data.per_page;
            //         total = data.data.total;
            //         // total_page = Math.ceil(total / per_page);
            //         // console.log(total_page);
            //         $('.signal_data').empty();
            //         for (var i = 0; i < signal_data_array.length; i++) {
            //             // console.log(signal_data_array[i]);
            //             $('.signal_data').append(
            //                 '<div class="row"><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div><div class="col-12 col-sm-12 col-md-8 col-lg-4"><div class="card bg-light card-rad"><div class="card-body"> <p class="fs-6 lh-1 text-center"><strong>' +
            //                 signal_data_array[i]['signal_text'] +
            //                 '</strong></p> <p class="text-center fs-6 lh-1 text-center mb-n3">' +
            //                 signal_data_array[i]['created_at'] +
            //                 '</p></div></div></div><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div></div><br>'
            //             );
            //         }

            //     }
            // });



        }
    </script>
@endsection
