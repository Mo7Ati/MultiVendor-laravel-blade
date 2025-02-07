@extends('layouts.dashboard')

@section('title', 'Users')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item ">Dashboard</li>
        <li class="breadcrumb-item active">Users</li>
    </ol>
@endsection

@section('content')

    @session('success')
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endsession

    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                    <br>
                    <a href="{{ route('dashboard.users.create') }}" class="btn-outline-info">Add User</a>
                    {{-- <div class="card-tools">
                        <form action="" method="GET">
                            <div>
                                <label for="">Active </label>
                                <input type="radio" name="status" value="active" >
                                <br>
                                <label for="">archived</label>
                                <input type="radio" name="status" value="archived" >

                            </div>

                            <div class="input-group input-group-sm" style="width: 200px;">
                                <input type="text" name="name" class="form-control float-right" placeholder=" name">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        search
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="container text-center">
                                            <div class="row align-items-start">
                                                <div class="col-2">
                                                    <a href="{{ route('dashboard.users.edit', $user) }}"
                                                        class="btn btn-outline-primary btn-sm"> Edit </a>
                                                </div>
                                                <div class="col-2">
                                                    <a href="{{ route('dashboard.users.show', $user) }}"
                                                        class="btn btn-outline-info btn-sm"> View </a>
                                                </div>
                                                <div class="col-2">
                                                    <form action="{{ route('dashboard.users.destroy', $user) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn-outline-danger btn-sm">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <h1>There Are no Users . </h1>
                            @endforelse


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->

    {{ $users->withquerystring() }}

@endsection
