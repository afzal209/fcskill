@extends('layouts.app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Gain Profit</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Gain Profit</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>List</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List of Gain Profit
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">

                        <table id="table_id" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php $i = 1 @endphp

                                @foreach ($gainprofits as $gainprofit)
                                <tr class="gradeX">
                                    <td>{{ $i }}</td>
                                    <td>
                                        <img src="{{$gainprofit->image}}" alt="" width="100px" height="100px">
                                    </td>
                                    <td>
                                        @if ($gainprofit->status == 1)
                                        <span class="badge badge-primary"> Pending </span>
                                        @elseif($gainprofit->status == 2)
                                        <span class="badge badge-success"> Approve </span>
                                        @endif
                                        <!-- {!! $gainprofit->status
                ? '<span class="badge badge-primary"> Pending </span>'
                : '<span class="badge badge-success"> App </span>' !!} -->
                                    </td>
                                    <td>
                                        {{ date('Y-m-d g:i A', strtotime($gainprofit->created_at)) }}
                                    </td>
                                    <td class="center">
                                        @if ($gainprofit->status == 1)
                                        <a href="" onclick="check_gain_status('{{$gainprofit->id}}',2)" class="btn btn-primary btn-xs">Approve</a><a href="" class="btn btn-warning btn-xs" onclick="check_gain_status('{{$gainprofit->id}}',3)">Reject</a>
                                        @elseif($gainprofit->status == 2)
                                        <a href="" class="btn btn-warning btn-xs" onclick="check_gain_status('{{$gainprofit->id}}',3)">Reject</a>
                                        @endif
                                        <!-- {!! $gainprofit->status
            ? '<a href="" class="btn btn-primary btn-xs" >Approve</a><a href=""class="btn btn-danger btn-xs">Reject</a>'
            : '<a href="" class="btn btn-danger btn-xs">Reject</a>' !!} -->


                                        <form method="post" action="">
                                            <button type="submit" class="btn btn-danger btn-xs">
                                                Delete
                                            </button>
                                        </form>



                                    </td>

                                </tr>

                                @php $i++ @endphp
                                @endforeach

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(e) {
        e.preventDefault();
        alert('test');

    });
    // function check_gain_status(id,status){
    //     // console.log(id,status);
    //         $.ajax({
    //             url : "{{ url('/admin/gain_profits/check_gain_status')}}",
    //             type : "post",
    //             data : {
    //                 "_token": "{{ csrf_token() }}",
    //                 "id" : id,
    //                 "status" : status,
    //             },
    //             success : function(data){
    //                 console.log(data);
    //             }
    //         });
    //     }
    
</script>
@endsection