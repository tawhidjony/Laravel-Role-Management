@extends('layouts.backend.app')
@section('title','users | ')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-inline-flex">
                        <h3>All Users</h3>
                        <a href="{{route('users.create')}}" class="btn btn-primary ml-auto">
                            Add New User
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered">
                            <thead>
                                 <tr>
                                     <th class="text-center" scope="col">SL</th>
                                     <th class="text-center" scope="col">Name</th>
                                     <th class="text-center" scope="col">Email</th>
                                     <th class="text-center" scope="col">Image</th>
                                     <th class="text-center" scope="col">Action</th>
                                 </tr>
                            </thead>
                            <tbody>
                                @if($users->count() == 0)
                                    <tr>
                                        <td colspan="5" class="text-center"><h2>Users is not available</h2></td>
                                    </tr>
                                @else
                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td class="text-center">{{$key + 1}}</td>
                                            <td class="text-center">{{$user->name}}</td>
                                            <td class="text-center">{{$user->email}}</td>
                                            <td class="text-center"><img src="{{URL::to($user->photo)}}" style="width: 50px; height: 50px; border-radius: 50px; border: 1px solid;padding: 2px;"></td>
                                            <td class="text-center">
                                                <a href="{{route('users.edit', $user->id)}}" class="float-left btn btn-primary btn-sm ">
                                                    <i class="far fa-edit"></i>
                                                    Edit
                                                </a>
                                                <form action="{{route('users.destroy', $user->id)}}", method="POST" class="ml-3">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn  btn btn-danger btn-sm "><i class="fas fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection