@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">New Institution</div>

                <div class="card-body">
                    <form method="POST" class="col-md-12 floaty-center" action="{{ route('super_admin.institutions.store') }}">
                        @csrf
                        {{method_field('POST')}}
                        <div class="form-group row">
                            <label for="name">Institution Name</label>
                            <input id="name" type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group row">
                            <label for="admin">Assign Admin</label>
                            <select class="form-control" name="user_id">
                                @foreach($admins as $admin)
                                <option value="{{$admin->id}}">{{$admin->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row mb-0">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
