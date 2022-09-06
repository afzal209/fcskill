@extends('layouts.web_master')
@section('content')
    <form action="" method="POST" id="formId">
        <div style="display: none;" id="msg">

        </div>
        <label for="">Username</label>
        <input type="name" name="name" id="name">
        <br>
        <br>
        <label for="">Email</label>
        <input type="email" name="email" id="email">
        <br>
        <br>
        <label for="">Password</label>
        <input type="password" name="password" id="password">
        <br>
        <br>
        <label for="">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
        <br>
        <label for="">Signal Type</label>
        <br>
        <label for="forex">Forex</label><input type="radio" name="type" id="forex" value="0"> <label
            for="crypto">Crypto</label><input type="radio" name="type" id="crypto" value="1"><label
            for="both">Both</label><input type="radio" name="type" id="both" value="2">
        <br>
        <input type="submit" value="Login" name="submit" id="submit">
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var name = $('#name').val('');
            var email = $('#email').val('');
            var password = $('#password').val('');
            var password_confirmation = $('#password_confirmation').val('');
            // alert();
            $('#submit').click(function(e) {
                e.preventDefault();
                // alert('submit')
                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var password_confirmation = $('#password_confirmation').val();
                var signal_type = $("input[name='type']:checked").val();
                // console.log(signal_type);
                $.ajax({
                    url: '/api/register',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": name,
                        "email": email,
                        "password": password,
                        "password_confirmation": password_confirmation,
                        'signal_type': signal_type,
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data.error) {
                            $('#msg').html('');
                            $('#msg').show();
                            $('#msg').html(data.error);
                        } else if (data.message) {
                            $('#msg').html('');
                            $('#msg').show();
                            $('#msg').html(data.message);
                        }
                    }
                    // localStorage.setItem('token', data.token);
                    // localStorage.setItem('user_data', data.user);
                    // }
                })
            })
        })
    </script>
@endsection
