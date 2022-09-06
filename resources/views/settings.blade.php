@extends('layouts.app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Settings</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Change Password</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Change Password</h5>
                </div>
                <div class="ibox-content">

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif



                    <form method="post" action="{{ route('change_password') }}" class="p-3">
                        @csrf
                        @method('PATCH')

                        <div class="form-row ">
                            <div class="form-group col-md-12">
                                <label for="old_password">Old Password <span class="text-danger">*</span></label>
                                <input type="password" name="old_password" class="form-control" required>
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row ">
                            <div class="form-group col-md-12">
                                <label for="password">New Password <span class="text-danger">*</span></label>
                                <input type="password" name="new_password" class="form-control" required>
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row ">
                            <div class="form-group col-md-12">
                                <label for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-save"></i>
                            Update
                        </button>

                    </form>


                </div>
            </div>
        </div>


        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Update Support Contact Details</h5>
                </div>
                <div class="ibox-content">

                    @if (session('contact_status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('contact_status') }}
                    </div>
                    @elseif (session('contact_error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('contact_error') }}
                    </div>
                    @endif

                    <form method="post" action="{{ route('update_support_details') }}" class="p-3">
                        @csrf
                        @method('PATCH')

                        <div class="form-row ">
                            <div class="form-group col-md-12">
                                <label for="phone_number">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone_number" class="form-control" value="{{ $support_phone->meta_value }}" required>
                            </div>
                        </div>

                        <div class="form-row ">
                            <div class="form-group col-md-12">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ $support_email->meta_value }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-save"></i>
                            Update
                        </button>

                    </form>


                </div>
            </div>
        </div>

    </div>
</div>

@endsection