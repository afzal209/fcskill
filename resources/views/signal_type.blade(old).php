@extends('layouts.web_master')
@section('content')
    <div id="signal_data" style="border: 2em"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.2/socket.io.js"></script>
    <script>
        // let socket = '';
        // let ip_address = '127.0.0.1';
        // let socket_port = '3000';
        // socket = io(ip_address + ':' + socket_port, {
        //     secure: true
        // });
        // // console.log(socket);
        // var getUser = localStorage.getItem('user_data');
        // var json_parse = JSON.parse(getUser);
        // var signal_type = json_parse.signal_type;
        // var getToken = localStorage.getItem('token');
        // socket.on('receivedSignalData', (message) => {
        //     // console.log(message)
        //     $('signal_data').empty();
        //     // if (message == signal_type) {
        //     // console.log(message)
        //     $.ajax({
        //         url: '/api/signal_check/' + message,
        //         headers: {
        //             'Authorization': 'Bearer ' + getToken
        //         },
        //         type: 'GET',
        //         success: function(data) {
        //             $('#signal_data').html('');
        //             // console.log(data);

        //             $.each(data.data, function(key, value) {
        //                 // console.log(value.signal_text);
        //                 // $('#signal_data').html(value.signal_text);
        //                 // socket.emit('receivedSignalData', value);
        //                 $('#signal_data').append(value.signal_text);
        //             })
        //             // $('#signal_data').html(data);
        //         }
        //     })
        //     // }



        // });
        $(document).ready(function() {

            var getToken = localStorage.getItem('token');
            if (!getToken) {
                window.location.href = 'web-login'
            }
            // console.log(getToken);
            var getUser = localStorage.getItem('user_data');
            var json_parse = JSON.parse(getUser);
            var signal_type = json_parse.signal_type;
            // var data = $('<div></div>');
            // console.log(signal_type);
            $.ajax({
                url: '/api/signal_check/' + signal_type,
                headers: {
                    'Authorization': 'Bearer ' + getToken
                },
                type: 'GET',

                success: function(data) {
                    // console.log(data);

                    $.each(data.data, function(key, value) {
                        // console.log(value.signal_text);
                        // $('#signal_data').html(value.signal_text);
                        // socket.emit('receivedSignalData', value);
                        $('#signal_data').append(value.signal_text);
                    })
                    // $('#signal_data').html(data);
                }
            })
        });
    </script>
@endsection
