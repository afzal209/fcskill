@extends('layouts.web_master')
@section('title', 'Signal')
@section('content')
<div class="row">
    <div class="alert alert-secondary text-center notify" style="display:none">
        
    </div>
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
<br>

<div class="pagination_list">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-4">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">

                </ul>
            </nav>
        </div>
        <div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>
    </div>
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.2/socket.io.js"></script> -->
<script>
    var getToken = localStorage.getItem('token');
    // if (!getToken) {
    //     window.location.href = '/'
    //     localStorage.setItem('click', 'true');
    // } else {
    //     var getUser = localStorage.getItem('user_data');
    //     var json_parse = JSON.parse(getUser);
    //     var signal_type = json_parse.signal_type;
    //     function signal_check(type){
    //          $('.signal_data').empty();
    //         var current_page = '';
    //         var last_page = '';
    //         var first_page_url = '';
    //         var last_page_url = '';
    //         var per_page = '';
    //         var total = '';
    //         $.ajax({
    //             url: '/api/signal_check/' + type,
    //             headers: {
    //                 'Authorization': 'Bearer ' + getToken
    //             },
    //             type: 'GET',

    //             success: function(data) {
    //                 console.log(data);
    //                 current_page = data.data.current_page;
    //                 // console.log(current_page);
    //                 last_page = data.data.last_page;
    //                 signal_data_array = data.data.data;
    //                 first_page_url = data.data.first_page_url;
    //                 last_page_url = data.data.last_page_url
    //                 per_page = data.data.per_page;
    //                 total = data.data.total;
    //                 total_page = Math.ceil(total / per_page);
    //                 console.log(total_page);
    //                 for (var i = 0; i < signal_data_array.length; i++) {
    //                     // console.log(signal_data_array[i]);
    //                     $('.signal_data').append(
    //                         '<div class="row"><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div><div class="col-12 col-sm-12 col-md-8 col-lg-4"><div class="card bg-light card-rad"><div class="card-body"> <p class="fs-6 lh-1 text-center"><strong>' +
    //                         signal_data_array[i]['signal_text'] +
    //                         '</strong></p> <p class="text-center fs-6 lh-1 text-center mb-n3">' +
    //                         signal_data_array[i]['created_at'] +
    //                         '</p></div></div></div><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div></div><br>'
    //                     );
    //                 }


    //             }
    //         });
    //     }
    // setInterval('signal_check(signal_type)', 5000);
    // }
    var selectedPageNo = 0;
    $(document).ready(function() {


        if (!getToken) {
            window.location.href = '/'
            localStorage.setItem('click', 'true');
        }
        var donemessage = $('#donemessage').val();
            if (donemessage != null) {

                toastr.success(donemessage, 'Success' ,{ timeOut: 3000 });

            }

            var errormessage = $('#errormessage').val();
            if (errormessage != null) {
                toastr.error(errormessage, 'Error' ,{ timeOut: 3000 });
            }


        var getUser = localStorage.getItem('user_data');
        var json_parse = JSON.parse(getUser);
        var signal_type = json_parse.signal_type;
        var id = json_parse.id;
        var email = json_parse.email;
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
                // console.log(data.data);
                // current_page = data.data.current_page;
                // // console.log(current_page);
                // last_page = data.data.last_page;
                // signal_data_array = data.data.data;
                // first_page_url = data.data.first_page_url;
                // last_page_url = data.data.last_page_url
                // per_page = data.data.per_page;
                // total = data.data.total;
                // total_page = Math.ceil(total / per_page);
                // // console.log(total_page);
                for (var i = 0; i < data.data.length; i++) {
                    //     // console.log(signal_data_array[i]);
                    // console.log(data.data);
                    $('.signal_data').append(
                        '<div class="row">' +
                        '<div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>' +
                        '<div class="col-12 col-sm-12 col-md-8 col-lg-4">' +
                        '<div class="card bg-light card-rad ">' +
                        '<div class="card-body ">' +
                        '<p class="fs-6 lh-1 text-center ">' +
                        '<strong>' + data.data[i]['signal_text'] + '</span>' +
                        '</p>' +
                        '<p class="text-center fs-6 lh-1 text-center mb-n3">' +
                        data.data[i]['created_at'] +
                        '</p>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-12 col-sm-12 col-md-2 col-lg-4"></div>' +
                        '<div>' +
                        '<br>'
                    )
                    //     $('.signal_data').append(
                    //         '<div class="row"><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div><div class="col-12 col-sm-12 col-md-8 col-lg-4"><div class="card bg-light card-rad"><div class="card-body"> <p class="fs-6 lh-1 text-center"><strong>' +
                    //         signal_data_array[i]['signal_text'] +
                    //         '</strong></p> <p class="text-center fs-6 lh-1 text-center mb-n3">' +
                    //         signal_data_array[i]['created_at'] +
                    //         '</p></div></div></div><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div></div><br>'
                    //     );
                    //     $('.signal_data').find('img').addClass("img-fluid")
                }


                var numberOfItems = $(".signal_data .row").length;
                // console.log(numberOfItems);

                var limitPerPage = 10;
                var totalPages = Math.ceil(numberOfItems / limitPerPage);

                var paginationSize = 7;
                var currentPage;

                function showPage(whichPage) {
                    if (whichPage < 1 || whichPage > totalPages) return false;
                    currentPage = whichPage;
                    $(".signal_data .row").hide()
                        .slice((currentPage - 1) * limitPerPage,
                            currentPage * limitPerPage).show();
                    // Replace the navigation items (not prev/next):            
                    $(".pagination li").slice(1, -1).remove();
                    getPageList(totalPages, currentPage, paginationSize).forEach(item => {
                        $("<li>").addClass("page-item")
                            .addClass(item ? "current-page" : "disabled")
                            .toggleClass("active", item === currentPage).append(
                                $("<a>").addClass("page-link").attr({
                                    href: "javascript:void(0)"
                                }).text(item || "...")
                            ).insertBefore("#next-page");
                    });
                    // // Disable prev/next when at first/last page:
                    $("#previous-page").toggleClass("disabled", currentPage === 1);
                    $("#next-page").toggleClass("disabled", currentPage === totalPages);
                    return true;
                }
                $(".pagination").append(
                    $("<li>").addClass("page-item").attr({
                        id: "previous-page"
                    }).append(
                        $("<a>").addClass("page-link").attr({
                            href: "javascript:void(0)"
                        }).text("Prev")
                    ),
                    $("<li>").addClass("page-item").attr({
                        id: "next-page"
                    }).append(
                        $("<a>").addClass("page-link").attr({
                            href: "javascript:void(0)"
                        }).text("Next")
                    )
                );
                $(".signal_data").show();
                showPage(1)

                $(document).on("click", ".pagination li.current-page:not(.active)", function() {
                    return showPage(+$(this).text());
                });
                $("#next-page").on("click", function() {
                    return showPage(currentPage + 1);
                });

                $("#previous-page").on("click", function() {
                    return showPage(currentPage - 1);
                });
                // //Create dynamic pages
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
                //         i + '" onclick="Paginate(' + i + ',' + signal_type + ')" href="#" >' +
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

        $.ajax({
                url: '/api/check_verified_email/' + id,
                headers: {
                    'Authorization': 'Bearer ' + getToken
                },
                type: 'GET',

                success: function(data) {
                    $('.notify').html('');
                    // console.log(data);
                    if (data.data == 1) {
                        $('.notify').show();
                        $('.notify').append('Kindly verify your account by clicking <button class="btn btn-primary" onclick="verify('+id+')">Verify</button> Your email :'+email);
                    }
                    else if(data.data == 2){
                        $('.notify').html('');
                        $('.notify').show();
                        $('.notify').append('Check Your email for verification');
                    }
                    else{
                        $('.notify').hide();
                        $('.notify').html('');
                    }
                }
            });
        // $('body').on('click', '.page-link', function() {
        //     // alert('yes');
        //     // console.log(this.id);
        //     var pageNoP = selectedPageNo;
        //     if (this.id == 'page_' + pageNoP) {
        //         console.log('page');
        //     } else if (this.id == 'btnPrev') {
        //         selectedPageNo = (selectedPageNo - 1) <= 1 ? 1 : selectedPageNo - 1;

        //         console.log('Prev');
        //     } else if (this.id == 'btnNext') {
        //         selectedPageNo = (selectedPageNo + 1) >= last_page ? last_page : selectedPageNo + 1;
        //         console.log('Next');
        //     }

        //     // console.log($('#btnNext').attr('data-btn'));
        //     // if ($('#btnPrev').attr('data-btn') == 'prev') {
        //     //     console.log('Prev');
        //     // } else if ($('#btnNext').attr('data-btn') == 'next') {
        //     //     console.log('Next');
        //     // }

        //     console.log("#page_" + pageNoP);

        //     // console.log(selectedPageNo);
        //     $('.paginate').removeClass("active-page");

        //     $("#page_" + selectedPageNo).addClass('active-page');

        //     if (selectedPageNo <= 1) {
        //         // console.log('yes');
        //         $('#btnPrev').attr('disabled', 'disabled');
        //     } else {
        //         $('#btnPrev').removeAttr('disabled');
        //     }
        //     // selectedPageNo--;

        //     // if (pageNoP == 1) {
        //     //     console.log(pageNoP);
        //     // }
        //     // console.log(this.id);
        //     // $('#' + this.id).addClass('active-page');
        //     // console.log(this);
        //     $.ajax({
        //         url: '/api/signal_check/' + signal_type + '?page=' + selectedPageNo,
        //         headers: {
        //             'Authorization': 'Bearer ' + getToken
        //         },
        //         type: 'GET',

        //         success: function(data) {
        //             console.log(data);
        //             //return;
        //             current_page = data.data.current_page;
        //             // console.log(current_page);
        //             last_page = data.data.last_page;
        //             signal_data_array = data.data.data;
        //             first_page_url = data.data.first_page_url;
        //             last_page_url = data.data.last_page_url
        //             per_page = data.data.per_page;
        //             total = data.data.total;
        //             // total_page = Math.ceil(total / per_page);
        //             // console.log(total_page);
        //             $('.signal_data').empty();
        //             for (var i = 0; i < signal_data_array.length; i++) {
        //                 // console.log(signal_data_array[i]);
        //                 $('.signal_data').append(
        //                     '<div class="row"><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div><div class="col-12 col-sm-12 col-md-8 col-lg-4"><div class="card bg-light card-rad"><div class="card-body"> <p class="fs-6 lh-1 text-center"><strong>' +
        //                     signal_data_array[i]['signal_text'] +
        //                     '</strong></p> <p class="text-center fs-6 lh-1 text-center mb-n3">' +
        //                     signal_data_array[i]['created_at'] +
        //                     '</p></div></div></div><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div></div><br>'
        //                 );
        //             }

        //         }
        //     });

        // });

    });

    function getPageList(totalPages, page, maxLength) {
        if (maxLength < 5) throw "maxLength must be at least 5";

        function range(start, end) {
            return Array.from(Array(end - start + 1), (_, i) => i + start);
        }

        var sideWidth = maxLength < 9 ? 1 : 2;
        var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
        var rightWidth = (maxLength - sideWidth * 2 - 2) >> 1;
        if (totalPages <= maxLength) {
            // no breaks in list
            return range(1, totalPages);
        }
        if (page <= maxLength - sideWidth - 1 - rightWidth) {
            // no break on left of page
            return range(1, maxLength - sideWidth - 1)
                .concat(0, range(totalPages - sideWidth + 1, totalPages));
        }
        if (page >= totalPages - sideWidth - 1 - rightWidth) {
            // no break on right of page
            return range(1, sideWidth)
                .concat(0, range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
        }
        // Breaks on both sides
        return range(1, sideWidth)
            .concat(0, range(page - leftWidth, page + rightWidth),
                0, range(totalPages - sideWidth + 1, totalPages));
    }


    function verify(id) {
        // console.log(id);
        $.ajax({
            url : '/api/verify_user',
            type: 'POST',
            data : {
                "_token": "{{ csrf_token() }}",
                "id" : id,
            },
            headers: {
                'Authorization': 'Bearer ' + getToken
            },
            success : function(data){
                console.log(data);
                // if (data.msg) {
                //     window.reload();
                //     toastr.success(data.msg, 'Success',{ timeOut: 3000 });
                // }
                // else{
                //     toastr.error(data.error, 'Error',{ timeOut: 3000 });
                // }
                // location.reload();
                // console.log(data);
            }
        })
    }

    // function Paginate(pageNo, type) {
    //     // console.lo
    //     $('#page_' + pageNo);
    //     $('.paginate').removeClass("active-page");
    //     $("#page_" + pageNo).addClass('active-page');

    //     selectedPageNo = pageNo;
    //     $.ajax({
    //         url: '/api/signal_check/' + type + '?page=' + pageNo,
    //         headers: {
    //             'Authorization': 'Bearer ' + getToken
    //         },
    //         type: 'GET',

    //         success: function(data) {
    //             console.log(data);
    //             //return;
    //             current_page = data.data.current_page;
    //             // console.log(current_page);
    //             last_page = data.data.last_page;
    //             signal_data_array = data.data.data;
    //             first_page_url = data.data.first_page_url;
    //             last_page_url = data.data.last_page_url
    //             per_page = data.data.per_page;
    //             total = data.data.total;
    //             // total_page = Math.ceil(total / per_page);
    //             // console.log(total_page);
    //             $('.signal_data').empty();

    //             for (var i = 0; i < signal_data_array.length; i++) {
    //                 // console.log(signal_data_array[i]);
    //                 $('.signal_data').append(
    //                     '<div class="row"><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div><div class="col-12 col-sm-12 col-md-8 col-lg-4"><div class="card bg-light card-rad"><div class="card-body"> <p class="fs-6 lh-1 text-center"><strong>' +
    //                     signal_data_array[i]['signal_text'] +
    //                     '</strong></p> <p class="text-center fs-6 lh-1 text-center mb-n3">' +
    //                     signal_data_array[i]['created_at'] +
    //                     '</p></div></div></div><div class="col-12 col-sm-12 col-md-2 col-lg-4"></div></div><br>'
    //                 );
    //             }

    //         }
    //     });
    // }

    // function prv_page(type) {
    //     console.log(type);
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



    // }
</script>
@endsection
