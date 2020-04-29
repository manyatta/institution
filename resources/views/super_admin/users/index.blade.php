@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Users Management</div>
                    <div class="float-right">
                        <a href="{{route('super_admin.users.create')}}">
                            <button type="button" class="btn btn-success">Add Admin</button>
                        </a>
                    </div>
                <div class="card-body">

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                        @foreach($users as $user)
                        <tbody>
                            <tr>
                            <th scope="row">{{ $user->id}}</th>
                            <td>{{ $user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{implode(', ',$user->roles()->get()->pluck('role')->toArray())}}</td>
                            <td>    
                                <a class="float-left" href="{{route('super_admin.users.edit', $user->id)}}"><button type="button" class="btn btn-success">Edit</button></a>
                                <form action="{{route('super_admin.users.destroy', $user)}}" method="POST" class="float-left">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                
                            </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
