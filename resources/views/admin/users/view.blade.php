@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white">
                    <h4>User Information
                        <a href="{{ url('users') }}" class="btn btn-primary btn-sm float-end">Back</a>
                    </h4>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <form action="{{ url('update-role/'.$user->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                            <label for="">Role: </label>
                            <select class="form-select w-100" name = "role_as" value = "">
                                <option value="0" {{$user->role_as == '0'? "selected":""}}>Customer</option>
                                <option value="1" {{$user->role_as == '1'? "selected":""}}>Admin</option>
                            </select>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary">Update Role</a>
                            </div>
                            </form>

                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="">First Name</label>
                            <div class="p-2 border">{{ $user->name }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Email</label>
                            <div class="p-2 border">{{ $user->email }}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Phone</label>
                            <div class="p-2 border">{{ $user->phone }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Address</label>
                            <div class="p-2 border">{{ $user->address }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Apartment</label>
                            <div class="p-2 border">{{ $user->apartment }}</div>
                        </div>

                        <div class="col-md-4">
                            <label for="">City</label>
                            <div class="p-2 border">{{ $user->city }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Province</label>
                            <div class="p-2 border">{{ $user->province }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Country</label>
                            <div class="p-2 border">{{ $user->country }}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Postal Code</label>
                            <div class="p-2 border">{{ $user->postalcode }}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

