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
                        <div class="form-row ">
                            <div class="form-group col-md-12">
                                <label for="signal_type">Signal Type <span class="text-danger">*</span></label>
                                <div class="i-checks">
                                    <label>
                                        <input type="radio" value="1"  name="signal_type" {{ ($user->signal_type == 1)? "checked" : ""}}>
                                        <i></i> Forex Signals
                                    </label>
                                </div>
                                <div class="i-checks">
                                    <label>
                                        <input type="radio" value="0" name="signal_type" {{ ($user->signal_type == 0)? "checked" : ""}}>
                                        <i></i> Crypto Signals
                                    </label>
                                </div>
                                <div class="i-checks">
                                    <label>
                                        <input type="radio" value="2" name="signal_type" {{ ($user->signal_type == 2)? "checked" : ""}}>
                                        <i></i> Both Signals
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="form-group col-md-12">
                                <label for="status">Page Permission</label>
                                <div class="i-checks">
                                    {{-- @dd($user_has_permission) --}}
                                    @foreach($permission as $key => $permission_value)
                                     {{-- @foreach($user_has_permission as $key => $has_value) --}}
                                    <div class="i-checks">
                                        <label>
                                            <input type="checkbox" name="permission_id[]" value="{{$permission_value->id}}" {{ in_array($permission_value->id ,$user_has_permission)? "checked" : ""}}>
                                            <i></i>{{$permission_value->permission_name}}
                                        </label>
                                    </div>
                                    @endforeach
                                    {{-- @endforeach --}}
                                     {{-- @dd($user_has_permission) --}}
                                    {{-- @foreach($user_has_permission as $key => $value) --}}
                                    {{-- @if($value->permission_name != '') --}}
                                    {{-- @if($value->permission_name == 'gain_profit') --}}
                                        {{-- <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="permission_name[]" value="gain_profit" {{ ($value->permission_name == 'gain_profit')? "checked" : ""}}>
                                                <i></i> Gain/Profit
                                            </label>
                                        </div>  --}}
                                    
                                    {{-- @else
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="permission_name[]" value="gain_profit" >
                                                <i></i> Gain/Profit
                                            </label>
                                        </div>
                                    @endif      --}}
                                    {{-- @endforeach
                                    @foreach($permission as $key => $value) --}}
                                    {{-- @if($value->permission_name != '')  --}}
                                    {{-- @elseif($value->permission_name == 'signal')
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="permission_name[]" value="signal" {{ ($value->permission_name == 'signal')? "checked" : ""}}>
                                                <i></i> Signal
                                            </label>
                                        </div> --}}
                                    
                                    {{-- @else
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="permission_name[]" value="signal" >
                                                <i></i> Signal
                                            </label>
                                        </div>
                                    @endif     --}}
                                    {{-- @endforeach
                                    @foreach($permission as $key => $value) --}}
                                    {{-- @if($value->permission_name != '') --}}
                                    {{-- @elseif($value->permission_name == 'prediction')
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="permission_name[]" value="prediction" {{ ($value->permission_name == 'prediction')? "checked" : ""}}>
                                                <i></i> Prediction
                                            </label>
                                        </div> --}}
                                    
                                    {{-- @else
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="permission_name[]" value="prediction" >
                                                <i></i> Prediction
                                            </label>
                                        </div>
                                    @endif     --}}
                                    {{-- @endforeach
                                    @foreach($permission as $key => $value) --}}
                                    {{-- @if($value->permission_name != '') --}}
                                    {{-- @elseif($value->permission_name == 'latest_update')
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="permission_name[]" value="latest_update" {{ ($value->permission_name == 'latest_update')? "checked" : ""}}>
                                                <i></i> Latest Update
                                            </label>
                                        </div> --}}
                                    
                                    {{-- @else
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="permission_name[]" value="latest_update" >
                                                <i></i> Latest Update
                                            </label>
                                        </div>
                                    @endif     --}}
                                    {{-- @endforeach
                                    @foreach($permission as $key => $value) --}}
                                    {{-- @if($value->permission_name != '') --}}
                                    {{-- @elseif($value->permission_name == 'news')
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="permission_name[]" value="news" {{ ($value->permission_name == 'news')? "checked" : ""}}>
                                                <i></i> News
                                            </label>
                                        </div> --}}
                                    
                                    {{-- @else
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="permission_name[]" value="news" >
                                                <i></i> News
                                            </label>
                                        </div>
                                    @endif     --}}
                                    {{-- @endif
                                    @endforeach --}}
                                </div>
                            </div>
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