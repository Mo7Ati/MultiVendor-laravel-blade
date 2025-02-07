@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item ">Dashboard</li>
        <li class="breadcrumb-item active">Users</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('dashboard.users.update', $user) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('put')
        @include('dashboard.users.form')

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
