@extends('layouts.dashboard')

@section('title', 'Roles')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item ">Dashboard</li>
        <li class="breadcrumb-item active">Roles</li>
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
                    <h3 class="card-title">Roles</h3>
                    <br>
                    <a href="{{ route('dashboard.roles.create') }}" class="btn-outline-info">Add Role</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Abilities</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ implode('/', $role->abilities()->where('type', 'allow')->pluck('ability')->toArray()) }}
                                    </td>
                                    <td>
                                        <div class="container text-center">
                                            <div class="row align-items-start">
                                                <div class="col-2">
                                                    <a href="{{ route('dashboard.roles.edit', $role) }}"
                                                        class="btn btn-outline-primary btn-sm"> Edit </a>
                                                </div>
                                                <div class="col-2">
                                                    <a href="{{ route('dashboard.roles.show', $role) }}"
                                                        class="btn btn-outline-info btn-sm"> View </a>
                                                </div>
                                                <div class="col-2">
                                                    <form action="{{ route('dashboard.roles.destroy', $role) }}"
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
                                <h1>There Are no Roles . </h1>
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

    {{ $roles->withquerystring() }}

@endsection
