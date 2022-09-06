@extends('layouts.web_master')
@section('content')
    <div id="signal_data" style="border: 2em"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.2/socket.io.js"></script>
    <script>
        $(document).ready(function() {

            var getToken = localStorage.getItem('token');
            if (!getToken) {
                window.location.href = 'web-login'
            }
            // console.log(getToken);
            var getUser = localStorage.getItem('user_data');
            var json_parse = JSON.parse(getUser);
            var id = json_parse.id;
            // var data = $('<div></div>');
            console.log(id);
            $.ajax({
                url: '/api/web-setting/' + id,
                headers: {
                    'Authorization': 'Bearer ' + getToken
                },
                type: 'GET',

                success: function(data) {
                    console.log(data);

                    //         // $.each(data.data, function(key, value) {
                    //         //     // console.log(value.signal_text);
                    //         //     // $('#signal_data').html(value.signal_text);

                    //         //     // $('#signal_data').append(value.signal_text);
                    //         // })
                    //         // $('#signal_data').html(data);
                }
            })
        });
    </script>
@endsection
