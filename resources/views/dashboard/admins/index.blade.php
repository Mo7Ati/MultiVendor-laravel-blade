@extends('layouts.dashboard')

@section('title', 'Admins')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item ">Dashboard</li>
        <li class="breadcrumb-item active">Admins</li>
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
                    <h3 class="card-title">Admins</h3>
                    <br>
                    <a href="{{ route('dashboard.admins.create') }}" class="btn-outline-info">Add Admin</a>
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
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                {{-- <th>Password</th> --}}
                                <th>Super Admin</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->phone_number }}</td>
                                    {{-- <td style="width: 10%"> $admin->password </td> --}}</td>}}
                                    <td>{{ $admin->super_admin }}</td>
                                    <td>{{ $admin->status }}</td>
                                    <td>
                                        <div class="container text-center">
                                            <div class="row align-items-start">
                                                <div class="col-2">
                                                    <a href="{{ route('dashboard.admins.edit', $admin) }}"
                                                        class="btn btn-outline-primary btn-sm"> Edit </a>
                                                </div>
                                                <div class="col-2">
                                                    <a href="{{ route('dashboard.admins.show', $admin) }}"
                                                        class="btn btn-outline-info btn-sm"> View </a>
                                                </div>
                                                <div class="col-2">
                                                    <form action="{{ route('dashboard.admins.destroy', $admin) }}"
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
                                <h1>There Are no Admins . </h1>
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

    {{ $admins->withquerystring() }}

@endsection
