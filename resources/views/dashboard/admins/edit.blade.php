@extends('layouts.dashboard')

@section('title', 'Edit Admin')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item ">Dashboard</li>
        <li class="breadcrumb-item active">Admins</li>
    </ol>
@endsection

@section('content')
    <form  action="{{ route('dashboard.admins.update', $admin) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('put')
        @include('dashboard.admins.form')
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
