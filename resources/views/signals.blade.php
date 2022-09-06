@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Signals</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Signals</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>List</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('add_signal') }}" class="btn btn-primary">Add New Signal</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of signals</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">

                            <table id="table_id" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Signal</th>
                                        <th>Type</th>
                                        <th>Created at</th>
                                        <th class="no-sort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php $i = 1 @endphp

                                    @foreach ($signals as $signal)
                                        <tr class="gradeX">
                                            <td>{{ $i }}</td>
                                            <td>
                                                {!! $signal->signal_text !!}
                                            </td>
                                            <td>
                                                {!! $signal->signal_type
                                                    ? '<span class="badge badge-primary"> Forex Signals </span>'
                                                    : '<span class="badge badge-success"> Crypto Signals </span>' !!}
                                            </td>
                                            <td>
                                                {{ date('Y-m-d g:i A', strtotime($signal->created_at)) }}
                                            </td>
                                            <td class="center">


                                                <a href="{{ route('signal_edit', ['id' => $signal->id]) }}"
                                                    class="btn btn-primary btn-xs">
                                                    Edit
                                                </a>


                                                <form method="post"
                                                    action="{{ route('signal_delete', ['id' => $signal->id]) }}">
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
