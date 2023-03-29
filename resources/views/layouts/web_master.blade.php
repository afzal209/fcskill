<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    @include('layouts.css')

    <title>FCSkill | @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
    <style>
        .active-page {
            background-color: lightblue;
            color: white;
        }

        #nav_signal {

            position: relative;

        }



        #nav_signal .badge {
            position: absolute;
            top: -1px;
            right: -5px;
            padding: 5px 10px;
            border-radius: 5%;
            background: red;
            color: white;
        }
    </style>
</head>

<body>
    @if (\Session::has('doneMessage'))
        <input type="hidden" id="donemessage" value="{{ \Session::get('doneMessage') }}">
    @endif
    @if (\Session::has('errorMessage'))
        <input type="hidden" id="errormessage" value="{{ \Session::get('errorMessage') }}">
    @endif
    @include('layouts.first_navbar')
    {{-- @include('layouts.second_navbar') --}}
    @include('layouts.third_navbar')

    <div class="container-fluid" style="background-image: linear-gradient(to
      right, #f87b1c, rgba(255,249,203,168));"><br>
        @yield('content')
    </div>

    @include('layouts.footer')
</body>

@include('layouts.script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    // var getToken = localStorage.getItem('token');
    // var getUser = localStorage.getItem('user_data');

    // var json_parse = '';
    // var user_id = '';
    // var type = '';
    // if (getUser != null) {
    //     json_parse = JSON.parse(getUser)
    //     user_id = json_parse.id
    //     type = json_parse.signal_type
    //     signal_count(user_id, type, 'view');
    // }

    // function signal_count(user_id, type, action) {
    //     var today = new Date();
    //     // console.log(data.data.length);
    //     var time = today.getHours() + "-" + today.getMinutes();
    //     var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    //     var dateTime = date + ' ' + time;
    //     // console.log('User Id'+user_id+'Type'+type+'Action'+action);
    //     $.ajax({
    //         url: '/api/signal_notify',
    //         headers: {
    //             'Authorization': 'Bearer ' + getToken
    //         },
    //         data: {
    //             "_token": "{{ csrf_token() }}",
    //             'user_id': user_id,
    //             'type': type,
    //             'action': action,
    //         },
    //         type: 'POST',
    //         success: function(data) {

    //             // console.log(data);
    //             if (data.data == 0) {
    //                 //     // $('.count').hide();
    //                 //     // console.log('No Counting');
    //                 $('.badge').html('');

    //             } else {
    //                 var count = data.data.length
    //                 // console.log(data);
    //                 $.each(data.data, function(key, value) {
    //                     // console.log(value);
    //                     var convertToday = new Date(value['created_at']);
    //                     var convertTime = convertToday.getHours() + "-" + convertToday.getMinutes();
    //                     var convertDate = convertToday.getFullYear() + '-' + (convertToday.getMonth() + 1) + '-' + convertToday.getDate();
    //                     var convertDateTime = convertDate + ' ' + convertTime;
    //                     if (convertDateTime == dateTime) {
    //                         signal_flag(user_id, type, 'flag', value['notification_text']);
    //                         // toastr.success(value['notification_text'], 'Success')
    //                     }
    //                 });
    //                 $('.badge').html(count);
    //             }

    //         }
    //     })
    // }

    // function signal_flag(user_id, type, action, message) {
    //     // console.log('User id:' +user_id +','+ 'Type:'+type+ 'Action'+action +'Message:'+message);
    //     $.ajax({
    //         url: '/api/signal_notify',
    //         headers: {
    //             'Authorization': 'Bearer ' + getToken
    //         },
    //         data: {
    //             "_token": "{{ csrf_token() }}",
    //             'user_id': user_id,
    //             'type': type,
    //             'action': action,
    //         },
    //         type: 'POST',
    //         success: function(data) {

    //             // console.log(data);
    //             if (data.count == 1) {
    //                 toastr.success(message, 'Success').delay(5000)
    //                     .fadeOut(4000);

    //             }


    //         }
    //     })
    // }


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

    function signal_page() {
        window.location.href = 'signal-type';
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
        var token = localStorage.getItem('token');
        var getUser = localStorage.getItem('user_data');
        var json_parse = '';
        var user_id = '';
        var type = '';
        if (token != null) {

            $('.after_login').hide();
            $('.after_register').hide();
            $('.after_logout').show();
        } else {
            $('.after_login').show();
            $('.after_register').show();
            $('.after_logout').hide();
        }
        var url = '';
        var firebaseConfig = {
            apiKey: "AIzaSyBwXDk9x0OQWXoWxQrM1B87t4HO1fNOnSk",
            authDomain: "fcskill-3de1b.firebaseapp.com",
            databaseURL: "https://fcskill-3de1b-default-rtdb.firebaseio.com",
            projectId: "fcskill-3de1b",
            storageBucket: "fcskill-3de1b.appspot.com",
            messagingSenderId: "636149404949",
            appId: "1:636149404949:web:d122a083e58671f5d6c51c",
            measurementId: "G-WD5V69Z0LP"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        if (getUser != null) {
            json_parse = JSON.parse(getUser)
            user_id = json_parse.id
            type = json_parse.signal_type
            
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/api/check_device_id',
                    type: 'POST',
                    data: {
                        device_id: response,
                        id : user_id,
                    },
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    // dataType: 'JSON',
                    success: function (response) {

                        // alert('Token stored.');
                        console.log('Token Add');
                    },
                    error: function (error) {
                        // alert(error);
                        console.log(error);
                    },
                });
            }).catch(function (error) {
                // alert(error);
                console.log(error);

            });
            messaging.onMessage(function (payload) {  
                // console.log(payload);  
                const title = payload.notification.title;
                const options = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                };
                new Notification(title, options);
            });
            
        }

        
        $("input[type='checkbox']").click(function() {
            if ($(this).prop("checked") == true) {
                $(':input[type="submit"][id="register"]').prop('disabled', false);
            } else if ($(this).prop("checked") == false) {
                $(':input[type="submit"][id="register"]').prop('disabled', true);
            }
        })

        // $('#nav_signal').click(function(e) {
        //     // alert('yes');
        //     e.preventDefault();
        //     // console.log(user_id);
        //     $.ajax({
        //         url: '/api/signal_notify',
        //         headers: {
        //             'Authorization': 'Bearer ' + getToken
        //         },
        //         data: {
        //             "_token": "{{ csrf_token() }}",
        //             'user_id': user_id,
        //             'type': type,
        //             'action': 'update',
        //         },
        //         type: 'POST',
        //         success: function(data) {
        //             // console.log(data.count);
        //             if (data.count == 1) {
        //                 // $('.count').hide();
        //                 // console.log('No Counting');
        //                 $('.count').html('');
        //                 window.location.href = 'signal-type';

        //             } else {
        //                 window.location.href = 'signal-type';
        //                 signal_count(user_id, type, 'view')
        //             }

        //         }
        //     })

        // })


        // setInterval(function() {
        //     signal_count(user_id, type, 'view');
        // }, 5000);
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
                        $('#msg').html('<h5>' + data.error + '</br>' + '</h5>');
                        // console.log(data.message);
                    } else if (data.message) {
                        $('#msg').html('');
                        $('#msg').show();
                        $('#msg').html('<h5>' + data.message + '</h5>');
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
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
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
                    'device_id' : response,
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
        });
        })
        $('#logo_main').on('click', function() {
            location.reload();
        })
    })
</script>

</html>