<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    @include('layouts.css')

    <title>FCSkill | @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
    <style>
        .active-page {
            background-color: lightblue;
            color: white;
        }
    </style>
</head>

<body>
    @include('layouts.first_navbar')
    {{-- @include('layouts.second_navbar') --}}
    @include('layouts.third_navbar')

    <div class="container-fluid"
        style="background-image: linear-gradient(to
      right, #f87b1c, rgba(255,249,203,168));"><br>
        @yield('content')
    </div>

    @include('layouts.footer')
</body>

@include('layouts.script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script>
    var getToken = localStorage.getItem('token');
    var getUser = localStorage.getItem('user_data');
   
    
    //  if (getUser != null) {
    //       var signal_data_array = '';
    //     var json_parse = JSON.parse(getUser);
    //     var signal_type = json_parse.signal_type;
       
    //     function signal_notify(type){
    //         // console.log(is_notify);
    //         $.ajax({
    //             url : '/api/signal_notify/'+ type ,
    //             headers: {
    //                 'Authorization': 'Bearer ' + getToken
    //             },
    //             data : {
    //                  "_token": "{{ csrf_token() }}",
    //             },

    //             type : "POST",
    //             success : function(data){
    //                 // console.log(data[1]);
    //                 // if($.trim(data) == ''){
    //                 //     console.log('Empty');
    //                 // }
    //                 // else{
    //                         if (data[1] == 1) {
    //                     // console.log('Yes');
    //                     // if(type == 1){
    //                     //         toastr.success('<a href="signal-type">Forex Signal Add</a>');
    //                     //     } else {
    //                     //         toastr.success('<a href="signal-type">Crypto Signal Add</a>')
    //                     //     }   
    //                     // }
    //                     // else{
    //                     //     console.log('Test');
    //                     // }
    //                 // }
    //                 // console.log('Repeat');
    //                 // if (data[1] = 'success') {
    //                 //     console.log('Yes');
    //                 //     // if(type = 0){
    //                 //     //     toastr.success('<a href="">Forex Signal Add</a>');
    //                 //     // } else {
    //                 //     //     toastr.success('<a href="">Crypto Signal Add</a>')
    //                 //     // }   
    //                 // }
    //                 // else{
    //                 //     console.log('Test');
    //                 // }
    //             }
    //         })
    //     }
    //     setInterval('signal_notify(signal_type)', 5000);

       
    // }


    function modal_open(id) {
        // $('#'+id).modal('show')
        // console.log(id);
        if (id == 'exampleModal') {
            $('#' + id).modal('hide');
            $('#exampleModal1').modal('show');
            $('#msg1').html('');
        } else if (id == 'exampleModal1') {
            $('#' + id).modal('hide');
            $('#exampleModal').modal('show');
            $('#msg ').html('');
        }
    }
    // const after_login = document.getElementsByClassName('after_login');
    // const after_logout = document.getElementsByClassName('after_logout')
    // // alert('test');
    // $(':input[type="submit"][id="register"]').prop('disabled', true);
    // const getToken = localStorage.getItem('token');
    // if (getToken) {
    //     // console.log('Yes');
    //     // after_login.style.display = 'none';
    //     // after_logout.style.display = 'block';
    //     for (var i = 0; i < after_login.length; i++) {
    //         after_login[i].style.display = 'none';
    //     }
    //     for (var i = 0; i < after_login.length; i++) {
    //         after_login[i].style.display = 'none';
    //     }
    // } else {
    //     // console.log('No');
    // }
    $(document).ready(function() {
        $(':input[type="submit"][id="register"]').prop('disabled', true);
        var getToken = localStorage.getItem('token');
        if (getToken != null) {

            $('.after_login').hide();
            $('.after_register').hide();
            $('.after_logout').show();
        } else {
            $('.after_login').show();
            $('.after_register').show();
            $('.after_logout').hide();
        }

        $("input[type='checkbox']").click(function() {
            if ($(this).prop("checked") == true) {
                $(':input[type="submit"][id="register"]').prop('disabled', false);
            } else if ($(this).prop("checked") == false) {
                $(':input[type="submit"][id="register"]').prop('disabled', true);
            }
        })
        // function logout() {
        //     console.log('Test');
        //     // localStorage.removeItem('user_data');
        //     // localStorage.removeItem('token');
        //     // window.location.href = '/'

        // }

        $('.after_logout').click(function(e) {
            e.preventDefault();
            // console.log('test');
            localStorage.removeItem('user_data');
            localStorage.removeItem('token');
            window.location.href = '/'
        })
        $('#login').click(function(e) {
            e.preventDefault();
            // alert('submit')
            var email = $('.email').val();
            var password = $('.password').val();
            // console.log('Email' + email, 'Password' + password);
            var data = {
                "_token": "{{ csrf_token() }}",
                "email": email,
                "password": password,
            };
            // console.log(data);

            $.ajax({
                url: '/api/login',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "email": email,
                    "password": password,
                },
                success: function(data) {
                    console.log(data);
                    if (data.error) {
                        $('#msg').html('');
                        $('#msg').show();
                        // if (data.error[0] == 'undefined') {
                        //     $('#msg').html('<h5>' + data.error[1] +'</br>'+ '</h5>');
                        // }
                        // else if(data.error[1] == 'undefined'){
                        //     $('#msg').html('<h5>' + data.error[0] +'</br>'+ '</h5>');
                        // }
                        $('#msg').html('<h5>' + data.error +'</br>'+ '</h5>');
                        // console.log(data.message);
                    }
                    else if(data.message){
                        $('#msg').html('');
                        $('#msg').show();
                        $('#msg').html('<h5>' + data.message + '</h5>');
                    } 
                    else {
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
        $('#msg1').html('');
        var name = $('.name_reg').val('');
        var email = $('.email_reg').val('');
        var password = $('.password_reg').val('');
        var password_confirmation = $('.password_confirmation_reg').val('');
        // alert();
        $('#register').click(function(e) {
            e.preventDefault();
            // alert('submit')
            var name = $('.name_reg').val();
            var email = $('.email_reg').val();
            var password = $('.password_reg').val();
            var password_confirmation = $('.password_confirmation_reg').val();
            var signal_type = $("input[name='gridRadios']:checked").val();
            // console.log('name' + name + 'email' + email + 'password' + password + 'confrim passord' +
            //     password_confirmation + 'signal type' + signal_type);
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
                        $('#msg1').html('');
                        $('#msg1').show();
                        $('#msg1').html(data.error);
                        $('#exampleModal1').modal('show');
                    } else if (data.message) {
                        $('#msg1').html('');
                        $('#msg1').show();
                        $('#msg1').html(data.message);
                        $('.name_reg').val('');
                        $('.email_reg').val('');
                        $('.password_reg').val('');
                        $('.password_confirmation_reg').val('');
                        $("input[type='checkbox']").val('');
                        $('#exampleModal').modal('show');
                        $('#exampleModal1').modal('hide');
                    }
                }
                // localStorage.setItem('token', data.token);
                // localStorage.setItem('user_data', data.user);
                // }
            })
        })
        $('#logo_main').on('click', function() {
            location.reload();
        })
    })
</script>

</html>
