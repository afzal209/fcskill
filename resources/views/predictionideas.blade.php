@extends('layouts.app')

@section('content')

<style>
    .prediction_img img{
        
        width: 150px !important;
        height: 150px !important;

    }
</style>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Prediction Ideas</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Prediction Ideas</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>List</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('add_predictions') }}" class="btn btn-primary">Add New Prediction Ideas</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of Prediction Ideas</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">

                            <table id="table_id" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Predication Ideas</th>
                                        <th>Type</th>
                                        <th>Created at</th>
                                        <th class="no-sort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php $i = 1 @endphp

                                    @foreach ($predictionideas as $predictionidea)
                                        <tr class="gradeX">
                                            <td>{{ $i }}</td>
                                            <td class="prediction_img">
                                                {!! $predictionidea->prediction_text !!}
                                            </td>
                                            <td>
                                                {!! $predictionidea->prediction_type
                                                    ? '<span class="badge badge-primary"> Forex Prediction Ideas </span>'
                                                    : '<span class="badge badge-success"> Crypto Prediction Ideas </span>' !!}
                                            </td>
                                            <td>
                                                {{ date('Y-m-d g:i A', strtotime($predictionidea->created_at)) }}
                                            </td>
                                            <td class="center">


                                                <a href="{{ route('predictions_edit', ['id' => $predictionidea->id]) }}"
                                                    class="btn btn-primary btn-xs">
                                                    Edit
                                                </a>


                                                <form method="post"
                                                    action="{{ route('predictions_delete', ['id' => $predictionidea->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                        class="btn btn-danger btn-xs">
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
@endsection
