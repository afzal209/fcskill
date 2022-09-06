@extends('layouts.app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Roles</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Roles</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>List</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="{{ route('add_role') }}" class="btn btn-primary">Add Role</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List of roles</h5>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">

                        <table id="table_id" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php $i = 1 @endphp

                                @foreach($users as $user)

                                <tr class="gradeX">
                                    <td>{{ $i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <label class="badge badge-success"> Editor </label>
                                    </td>

                                    <td class="center">


                                        <a href="{{ route('role_edit', ['id'=> $user->id]) }}" class="btn btn-primary btn-xs">
                                            Edit
                                        </a>


                                        <form method="post" action="{{ route('role_delete', ['id'=> $user->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs">
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