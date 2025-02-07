@extends('layouts.dashboard')

@section('title', 'Edit Role')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item ">Dashboard</li>
        <li class="breadcrumb-item active">Roles</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('dashboard.roles.update', $role) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('put')
        @include('dashboard.roles.form')

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
