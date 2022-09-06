@extends('layouts.web_master')
@section('title', 'Daily News')
@section('content')
    {{-- <div class="row daily-news">

    </div> --}}
    {{-- <div class="container">
        <div class="row daily-news">

        </div>
    </div> --}}
    <div class="container-fluid">
        <br>
        <div class="row justify-content-center daily-news">

        </div><br>


    </div>

    {{-- <div class="container">
        <div class="row">
            <div class="col mt-3"><a href="#">
                    <div class="card" style="width: 18rem; border: none;">
                        <img src="{{ asset('images/blog3.png') }}" class="card-img-top" alt="...">
                        <div class="card-body p-1">
                            <p class="card-text" style="color:#98700d"><small>22 days ago</small></p>
                            <h5 class="card-title"><span class="d-inline-block text-truncate" style="max-width: 200px;">
                                    We are a marketing agency focused on B2B clients mainly in the Financial, IT,
                                    Professional Services, SaaS and some other diverse sectors.
                                </span></h5>
                            <p class="card-text">We are a marketing agency focused on B2B clients mainly in the Financial,
                                IT, Professional Services, SaaS and some other diverse sectors.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var selectedPageNo = 0;
        $(document).ready(function() {
            var daily_new = '';
            var date = '';
            var year = '';
            var month = '';
            var day = '';
            var newDate = '';
            var arr = '';
            var split = '';
            var img = '';
            var time = '';
            var heading = '';
            var para = '';
            var new_for_data = '';
            var removeTag = '';
            var srcImage = '';
            var current_page = '';
            var last_page = '';
            var first_page_url = '';
            var last_page_url = '';
            var per_page = '';
            var total = '';
            var arr = '';
            var new_data_array = '';
            var split = '';
            $.ajax({
                url: "/api/daily_news_add",
                type: "GET",
                success: function(data) {
                    console.log(data);
                    current_page = data.data.current_page;
                    // console.log(current_page);
                    last_page = data.data.last_page;
                    new_data_array = data.data.data;
                    // console.log(new_data_array);
                    first_page_url = data.data.first_page_url;
                    last_page_url = data.data.last_page_url
                    per_page = data.data.per_page;
                    total = data.data.total;
                    // console.log(new_data_array);
                    for (var k = 0; k < new_data_array.length; k++) {
                        // console.log(new_data_array[k]);
                        split = new_data_array[k]['news_text'].split(/\r\n|\r|\n/);
                        // console.log(split);
                        img = split[0].replace(/<\/?p>/g, '')
                        srcImage = img.split('src=')[1].split(/[ >]/)[0].replace(/"/g, '');
                        heading = split[2].replace(/<\/?h1>/g, '')
                        para = split[4].replace(/<\/?p>/g, '');
                        // arr = new_data_array[i];
                        // console.log(arr);
                        daily_new =
                            '<div class="col-12 col-sm-12 col-md-1 col-lg-1"><br></div>' +
                            '<div class="col-12 col-sm-12 col-md-10 col-lg-10">' +
                            '   <div class="card">' +
                            '       <img src="' + srcImage + '" class="card-img-top" alt="...">' +
                            '       <div class="card-body">' +
                            '           <h5 class="card-title text-center">' +
                            '                   <p style="color:#343a40">' + heading + '</p>' +
                            '           </h5>' +
                            '           <p class="card-text lh-sm text-center"><small>' + para +
                            '</small></p>' +
                            // '           <p class="mt-n2 text-center" style="color:#343a40"><small>RTTNews | ' +
                            // moment(
                            //     new_data_array[k]['created']).startOf('hour').fromNow() +
                            // '</small></p>' +
                            '       </div>' +
                            '   </div>' +
                            '</div>' +
                            '<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>' +
                            '<br>';
                        $('.daily-news').append(daily_new);
                    };
                    // Dynamic Page Link
                    if (per_page < total) {
                        var paginationButton =
                            '<div class="row justify-content-center">' +
                            '   <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>' +
                            '   <div class="col-12 col-sm-12 col-md-8 col-lg-4">' +
                            '       <nav aria-label="Page navigation example">' +
                            '           <ul class="pagination justify-content-center">' +
                            '               <li class="page-item ">' +
                            '                   <button class="page-link"  id="btnPrev" tabindex="-1" disabled>Previous</button>' +
                            '               </li>';
                        for (var j = 1; j <= last_page; j++) {
                            paginationButton +=
                                '               <li class="page-item"><a class="page-link paginate' + (
                                    j ==
                                    1 ?
                                    " active-page " : "") + '" id="page_' +
                                j + '" onclick="Paginate(' +
                                j + ')" href="#">' + j +
                                '</a></li>';
                        }
                        paginationButton +=
                            '               <li class="page-item">' +
                            '                   <button class="page-link" id="btnNext">Next</button>' +
                            '               </li>' +
                            '           </ul>' +
                            '       </nav>' +
                            '   </div>' +
                            '   <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>' +
                            '</div>';
                        $('.daily-news').after(paginationButton)
                    }

                    // $.each(data.data, function(key, value) {
                    //     console.log(value);
                    //     var arr = value.news_text;
                    //     // console.log(arr.split(/\r\n|\r|\n/));
                    //     var split = arr.split(/\r\n|\r|\n/);
                    //     // console.log(split[0].replace(/<\/?[^>]+(>|$)/g, ""));
                    //     // removeTag = split[0].replace(/<\/?[^>]+(>|$)/g, "");
                    //     // console.log(removeTag);
                    //     // console.log(split);
                    //     img = split[0].replace(/<\/?h2>/g, '');
                    //     // console.log(img);
                    //     srcImage = img.split('src=')[1].split(/[ >]/)[0].replace(/"/g, '');
                    //     // console.log(srcImage);
                    //     time = split[2].replace(/<\/?p>/g, '')
                    //     heading = split[4].replace(/<\/?h1>/g, '')
                    //     para = split[6].replace(/<\/?p>/g, '');
                    //     // arr.push(value.news_text);
                    //     // console.log(value.news_text);
                    //     // for (var i = 0; i < arr.length; i++) {
                    //     //     // console.log(arr[i]);
                    //     //     new_for_data = arr[i];
                    //     //     console.log(new_for_data);
                    //     // }
                    //     // date = new Date(value.created_at);
                    //     // // console.log(date);
                    //     // var moment_date = moment(date).format('YYYYMMDD');
                    //     // console.log();
                    //     // console.log(moment_date);
                    //     // year = date.getFullYear();
                    //     // month = date.getMonth();
                    //     // day = date.getDate();
                    //     // newDate = year + '-' + month + '-' + day;
                    //     // console.log(newDate);
                    //     // daily_new =
                    //     //     '<div class="col-12 col-sm-12 col-md-1 col-lg-1"><br></div>' +
                    //     //     '<div class="col-12 col-sm-12 col-md-10 col-lg-10">' +
                    //     //     '   <div class="card">' +
                    //     //     '       <img src="' + srcImage + '" class="card-img-top" alt="...">' +
                    //     //     '       <div class="card-body">' +
                    //     //     '           <h5 class="card-title">' +
                    //     //     '               <a href="#">' +
                    //     //     '                   <p style="color:#343a40">' + heading + '</p>' +
                    //     //     '               </a>' +
                    //     //     '           </h5>' +
                    //     //     '           <p class="card-text lh-sm"><small>' + para + '</small></p>' +
                    //     //     '           <p class="mt-n2" style="color:#343a40"><small>RTTNews | ' + moment(
                    //     //         value.created).startOf('hour').fromNow() + '</small></p>' +
                    //     //     '       </div>' +
                    //     //     '   </div>' +
                    //     //     '</div>' +
                    //     //     '<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>' +
                    //     //     '<br>';
                    //     // var paginationButton =
                    //     //     '<div class="row justify-content-center">' +
                    //     //     '   <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>' +
                    //     //     '   <div class="col-12 col-sm-12 col-md-8 col-lg-4">' +
                    //     //     '       <nav aria-label="Page navigation example">' +
                    //     //     '           <ul class="pagination justify-content-center">' +
                    //     //     '               <li class="page-item disabled">' +
                    //     //     '                   <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>' +
                    //     //     '               </li>' +
                    //     //     '               <li class="page-item"><a class="page-link" href="#">1</a></li>' +
                    //     //     '               <li class="page-item"><a class="page-link" href="#">2</a></li>' +
                    //     //     '               <li class="page-item"><a class="page-link" href="#">3</a></li>' +
                    //     //     '               <li class="page-item">' +
                    //     //     '                   <a class="page-link" href="#">Next</a>' +
                    //     //     '               </li>' +
                    //     //     '           </ul>' +
                    //     //     '       </nav>' +
                    //     //     '   </div>' +
                    //     //     '   <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>' +
                    //     //     '</div>';
                    //     // $('.daily-news').append(daily_new);
                    //     // $('.daily-news').after(paginationButton)
                    // });
                }
            })
            $('body').on('click', '.page-link', function() {
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

                $('.paginate').removeClass("active-page");

                $("#page_" + selectedPageNo).addClass('active-page');

                if (selectedPageNo <= 1) {
                    // console.log('yes');
                    $('#btnPrev').attr('disabled', 'disabled');
                } else {
                    $('#btnPrev').removeAttr('disabled');
                }
                // selectedPageNo--;

                $.ajax({
                    url: "/api/daily_news_add?page=" + selectedPageNo,
                    type: "GET",
                    success: function(data) {
                        // console.log(data.data.data);
                        current_page = data.data.current_page;
                        // console.log(current_page);
                        last_page = data.data.last_page;
                        new_data_array = data.data.data;
                        // console.log(new_data_array);
                        first_page_url = data.data.first_page_url;
                        last_page_url = data.data.last_page_url
                        per_page = data.data.per_page;
                        total = data.data.total;
                        $('.daily-news').empty();
                        // console.log(new_data_array);
                        for (var k = 0; k < new_data_array.length; k++) {
                            // console.log(new_data_array[k]);
                            split = new_data_array[k]['news_text'].split(/\r\n|\r|\n/);
                            // console.log(split);
                            img = split[0].replace(/<\/?p>/g, '')
                            srcImage = img.split('src=')[1].split(/[ >]/)[0].replace(/"/g, '');
                            heading = split[2].replace(/<\/?h1>/g, '')
                            para = split[4].replace(/<\/?p>/g, '');
                            // arr = new_data_array[i];
                            // console.log(arr);
                            daily_new =
                                '<div class="col-12 col-sm-12 col-md-1 col-lg-1"><br></div>' +
                                '<div class="col-12 col-sm-12 col-md-10 col-lg-10">' +
                                '   <div class="card">' +
                                '       <img src="' + srcImage +
                                '" class="card-img-top" alt="...">' +
                                '       <div class="card-body">' +
                                '           <h5 class="card-title">' +
                                '               <a href="#">' +
                                '                   <p style="color:#343a40">' + heading +
                                '</p>' +
                                '               </a>' +
                                '           </h5>' +
                                '           <p class="card-text lh-sm"><small>' + para +
                                '</small></p>' +
                                '           <p class="mt-n2" style="color:#343a40"><small>RTTNews | ' +
                                moment(
                                    new_data_array[k]['created']).startOf('hour').fromNow() +
                                '</small></p>' +
                                '       </div>' +
                                '   </div>' +
                                '</div>' +
                                '<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>' +
                                '<br>';
                            $('.daily-news').append(daily_new);
                        };
                        // Dynamic Page Link


                    }
                })
            });
        })

        function Paginate(pageNo) {
            $('.paginate').removeClass("active-page");
            $("#page_" + pageNo).addClass('active-page');
            selectedPageNo = pageNo;
            $.ajax({
                url: "/api/daily_news_add?page=" + pageNo,
                type: "GET",
                success: function(data) {
                    // console.log(data.data.data);
                    current_page = data.data.current_page;
                    // console.log(current_page);
                    last_page = data.data.last_page;
                    new_data_array = data.data.data;
                    // console.log(new_data_array);
                    first_page_url = data.data.first_page_url;
                    last_page_url = data.data.last_page_url
                    per_page = data.data.per_page;
                    total = data.data.total;
                    $('.daily-news').empty();
                    // console.log(new_data_array);
                    for (var k = 0; k < new_data_array.length; k++) {
                        // console.log(new_data_array[k]);
                        split = new_data_array[k]['news_text'].split(/\r\n|\r|\n/);
                        // console.log(split);
                        img = split[0].replace(/<\/?p>/g, '')
                        srcImage = img.split('src=')[1].split(/[ >]/)[0].replace(/"/g, '');
                        heading = split[2].replace(/<\/?h1>/g, '')
                        para = split[4].replace(/<\/?p>/g, '');
                        // arr = new_data_array[i];
                        // console.log(arr);
                        daily_new =
                            '<div class="col-12 col-sm-12 col-md-1 col-lg-1"><br></div>' +
                            '<div class="col-12 col-sm-12 col-md-10 col-lg-10">' +
                            '   <div class="card">' +
                            '       <img src="' + srcImage + '" class="card-img-top" alt="...">' +
                            '       <div class="card-body">' +
                            '           <h5 class="card-title">' +
                            '               <a href="#">' +
                            '                   <p style="color:#343a40">' + heading + '</p>' +
                            '               </a>' +
                            '           </h5>' +
                            '           <p class="card-text lh-sm"><small>' + para + '</small></p>' +
                            '           <p class="mt-n2" style="color:#343a40"><small>RTTNews | ' +
                            moment(
                                new_data_array[k]['created']).startOf('hour').fromNow() +
                            '</small></p>' +
                            '       </div>' +
                            '   </div>' +
                            '</div>' +
                            '<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>' +
                            '<br>';
                        $('.daily-news').append(daily_new);
                    };
                    // Dynamic Page Link


                }
            })
        }
    </script>
@endsection
