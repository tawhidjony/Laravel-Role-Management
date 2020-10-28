@extends('layouts.backend.app')
@section('title','User - ')
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
                        <h2>Edit Profile</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{route('profile.update', $user->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('profile.form')
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="submit" class="btn btn-primary" value="Save Changes">
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
