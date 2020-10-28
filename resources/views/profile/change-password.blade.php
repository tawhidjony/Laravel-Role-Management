@extends('layouts.backend.app')
@section('title','edit password | ')
@section('content')

    <div class="container-fluid">
        <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{URL::to(Auth::user()->photo)}}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                            <p class="text-muted text-center">{{Auth::user()->email}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                              {{--  <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>--}}
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <h2>Change Password</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{url('update-password')}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Old Password</label>
                                <div class="col-lg-9">
                                    <input id="old_password" type="password"
                                           class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                           name="old_password" >

                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('old_password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">New Password</label>
                                <div class="col-lg-9">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" @if(!$user->password) required @endif>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Confirm New Password</label>
                                <div class="col-lg-9">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" @if(!$user->password) required @endif>
                                </div>
                            </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-3">
                                            <input type="submit" class="btn btn-primary" value="Save Changes">
                                        </div>
                                        <div class="col-lg-4">

                                        </div>
                                    </div>
                        </form>
                        </div>
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
        </div>
    </div>
@endsection
