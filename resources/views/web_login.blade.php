@extends('layouts.web_master')
@section('content')
    <form action="" method="POST" id="formId">
        <div style="display: none;" id="msg">

        </div>
        <label for="">Email</label>
        <input type="email" name="email" id="email">
        <br>
        <br>
        <label for="">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Login" name="submit" id="submit">
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var getToken = localStorage.getItem('token');
            if (getToken) {
                window.location.href = 'signal-type'
            }

            // alert();
            $('#submit').click(function(e) {
                e.preventDefault();
                // alert('submit')
                var email = $('#email').val();
                var password = $('#password').val();
                $.ajax({
                    url: '/api/login',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "email": email,
                        "password": password,
                    },
                    success: function(data) {
                        // console.log(data.code);
                        if (data.message) {
                            $('#msg').show();
                            $('#msg').html('<h5>' + data.message + '</h5>');
                            // console.log(data.message);
                        } else {
                            $('#msg').hide();
                            $('#msg').html('');
                            localStorage.setItem('token', data.token);
                            localStorage.setItem('user_data', JSON.stringify(data.user));
                            window.location.href = data.redirect_url;
                        }
                        // localStorage.setItem('token', data.token);
                        // localStorage.setItem('user_data', data.user);
                    }
                })
            })
        })
    </script>
@endsection
