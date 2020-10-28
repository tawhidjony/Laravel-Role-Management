@extends('layouts.backend.app')
@section('title','Users - ')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-inline-flex">
                        <h3>All User Roles</h3>
                        <a href="{{route('roles.create')}}" class="btn btn-primary ml-auto">
                            Add New Role
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><img src="{{URL::to('images/'.$user->photo)}}" style="width: 60px; height: 60px"></td>
                                    <td>
                                        <div class="text-center">
                                            <div class="btn-group">


                                                <a href="{{route('users.edit',$user->id)}}" class="btn btn-social-icon btn-info  button-style"><i class="fa fa-pencil-square-o fa-edit"></i></a>
                                                <form class="btn btn-social-icon btn-danger button-style" user="deleteForm" method="POST" action="{{route('users.destroy', $user->id)}}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="javascript:void(0);" onclick="deleteWithSweetAlert(event,parentNode);" >
                                                        <button class="btn btn-social-icon btn-danger button-style" ><i class="fa fa-trash-o fa-delete"></i></button>
                                                    </a>
                                                </form>

                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection