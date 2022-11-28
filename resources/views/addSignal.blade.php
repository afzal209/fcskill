@extends('layouts.app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Signals</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('signals') }}">Signals</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>New Signal</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="{{ route('signals') }}" class="btn btn-primary">Back to Signals</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Add Signal</h5>
                </div>
                <div class="ibox-content">


                    <form method="post" action="" class="p-3">
                        @csrf

                        <div class="form-group">
                            <label> Signal </label>
                            <textarea class="form-control" id="signal_text" name="signal_text"></textarea>
                        </div>

                        <div class="form-row ">
                            <div class="form-group col-md-12">
                                <label for="signal_type">Signal Type <span class="text-danger">*</span></label>
                                <div class="i-checks">

                                    <label>
                                        <input type="radio" value="1" checked="" name="signal_type">
                                        <i></i> Forex Signals
                                    </label>
                                </div>
                                <div class="i-checks">
                                    <label>
                                        <input type="radio" value="0" name="signal_type">
                                        <i></i> Crypto Signals
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-row ">
                            <div class="form-group col-md-12">
                                <label for="status">Both for Web</label>
                                <div class="i-checks">

                                    <div class="i-checks">
                                        <label>
                                            <input type="checkbox" name="status_both" value="2">
                                            <i></i> Both
                                        </label>
                                    </div>

                                </div>

                            </div>
                        </div>-->
                        <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-save"></i>
                            SAVE</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.2/socket.io.js"></script> -->

<script>
    $(document).ready(function() {
        // let socket = '';

        // let ip_address = '127.0.0.1';
        // let socket_port = '3004';
        // socket = io(ip_address + ':' + socket_port);
        // alert();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.mb-1').click(function(e) {
            e.preventDefault();
            // alert('yes');
            var signal_text = CKEDITOR.instances['signal_text'].getData();
            var signal_type = $("input[name='signal_type']:checked").val();
            // var status_both = $("input[name='status_both']:checked").val();

            // console.log('Signal Text' + signal_text + 'Signal Type' + signal_type);
            $.ajax({
                url: "{{ url('/admin/signals/store') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "signal_text": signal_text,
                    "signal_type": signal_type,
                    // "status_both": status_both,
                },
                success: function(data) {

                    // console.log(data);
                    toastr.success(data.doneMessage, 'Success');
                    // // // socket.emit('receivedSignalData', data.data);
                    CKEDITOR.instances['signal_text'].setData('');

                }
            });
        })
    })
</script>
@endsection