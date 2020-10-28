@extends('layouts.backend.app')
@section('title','users | ')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-inline-flex">
                        <h3>Create New User</h3>
                        <a href="{{route('users.index')}}" class="btn btn-primary ml-auto">
                            Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form id="usersForm" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('users.form')

                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success  pull-right"><i class="fa fa-pencil-square-o"></i> Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
