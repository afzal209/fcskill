@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Trading Tips</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Trading Tips</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>List</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('add_tradings') }}" class="btn btn-primary">Add New Trading Tips</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of Trading Tips</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">

                            <table id="table_id" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Trading Tips</th>
                                        <th>Created at</th>
                                        <th class="no-sort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php $i = 1 @endphp

                                    @foreach ($tradingtips as $tradingtip)
                                        <tr class="gradeX">
                                            <td>{{ $i }}</td>
                                            <td>
                                                {!! $tradingtip->trading_text !!}
                                            </td>
                                            <td>
                                                {{ date('Y-m-d g:i A', strtotime($tradingtip->created_at)) }}
                                            </td>
                                            <td class="center">


                                                <a href="{{ route('tradings_edit', ['id' => $tradingtip->id]) }}"
                                                    class="btn btn-primary btn-xs">
                                                    Edit
                                                </a>


                                                <form method="post"
                                                    action="{{ route('tradings_delete', ['id' => $tradingtip->id]) }}">
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
