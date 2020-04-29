@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Institutions Management</div>
                    
                <div class="card-body">
                <div class="float-right">
                    <a href="{{route('super_admin.institutions.create')}}">
                        <button type="button" class="btn btn-success">Add Institution</button>
                    </a>
                </div>

                <br>
                
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($institutions as $institution)
                        <tr>
                        <th scope="row">{{$institution->id}}</th>
                        <td>{{$institution->name}}</td>
                        <td>{{$institution->user->name}}</td>
                        <td>@mdo</td>
                        </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
