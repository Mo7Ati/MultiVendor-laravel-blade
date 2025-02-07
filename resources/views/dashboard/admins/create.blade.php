@extends('layouts.dashboard')

@section('title', 'Create Admin')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item ">Dashboard</li>
        <li class="breadcrumb-item active">Admins</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('dashboard.admins.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('dashboard.admins.form')
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
