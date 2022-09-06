@extends('layouts.app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Roles</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('roles') }}">Roles</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Update Role</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="{{ route('roles') }}" class="btn btn-primary">Back to Roles</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Update Role</h5>
                </div>
                <div class="ibox-content">


                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <form method="post" action="{{ route('role_update', $user->id) }}" class="p-3">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label> Name </label>
                            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">
                            <label> Email </label>
                            <input type="email" name="email" placeholder="Email" class="form-control" value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group">
                            <label> Password </label>
                            <input type="password" name="password" placeholder="Password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label> Confirm Password </label>
                            <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary mb-1">
                            <i class="fa fa-save"></i>
                            Update
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection