@extends('layouts.backend.app')
@section('title','users | ')
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
                   <table class="table table-bordered">
                       <thead>
                            <tr>
                                <th class="text-center" scope="col">SL</th>
                                <th class="text-center" scope="col">Name</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                       </thead>
                       <tbody>
                            @if($roles->count() == 0)
                                <tr>
                                    <td colspan="3" class="text-center"><h2>Role is not available</h2></td>
                                </tr>
                            @else
                                @foreach ($roles as $key => $role)
                                <tr>
                                    <td width="33%" class="text-center">{{$key + 1}}</td>
                                    <td width="33%" class="text-center">{{$role->name}}</td>
                                    <td width="33%" class="text-center" style=" display: flex; width: 100%; justify-content: center;">
                                        <a href="{{route('roles.edit', $role->id)}}" class="float-left btn btn-primary btn-sm ">
                                            <i class="far fa-edit"></i>
                                            Edit
                                        </a>
                                        <form action="{{route('roles.destroy', $role->id)}}", method="POST" class="ml-3">
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
