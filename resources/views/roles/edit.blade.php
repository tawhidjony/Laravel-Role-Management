@extends('layouts.backend.app')
@section('title','users | ')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-inline-flex">
                        <h3>Edit Role</h3>
                        <a href="{{route('roles.index')}}" class="btn btn-primary ml-auto">
                            Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form id="rolesForm" action="{{route('roles.update',$role->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            @include('roles.form')
                            <div class="col-sm-2">
                                <button class="btn btn-success mt-4">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
