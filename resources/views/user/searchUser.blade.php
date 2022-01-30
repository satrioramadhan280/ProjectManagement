@extends('layouts.app')

@section('title')
    search for '{{ $search }}'
@endsection

@section('content')
    <h4>search for '{{ $search }}'</h4>
    <hr>
    <div class="d-inline">
        @can('Admin')
            <a href="{{ url('/admin/create') }}" class="btn btn-primary mb-3">Add New User</a>
        @endcan
        <div class="d-block">
            <form class="d-flex flex-row justify-content-start align-items-start" method="GET" action="/searchUser">
                <div class="flex-fill pt-2 pr-2 pb-2">
                    <input class="form-control mr-2 mb-2" type="search" placeholder="Search by name" aria-label="Search" name="search" value="{{ request()->query('search') }}">
                    @canany(['Admin', 'HDiv'])
                    <div class="w-25">
                        <select class="form-select" name="filterDept" aria-label="Default select example">
                            <option value="">Filter Department</option>
                            @foreach ($roles as $role)
                                @php
                                    $display = $role->display;
                                    $array_of_display = explode(" ", $display);
                                    $slice_display = array_slice($array_of_display, 2);
                                    $combined_display = implode(" ", $slice_display);
                                @endphp
                                <option value="{{ $role->id }}" @if(request()->query('filterDept') == $role->id) selected @endif> {{ $combined_display }} </option>
                            @endforeach
                        </select>
                    </div>
                    @endcanany
                </div>
                <div class="pt-2 pr-2 pb-2">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
        @error('search')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    @if (session('create'))
        <div class="alert alert-success mt-3">
            {{ session('create') }}
        </div>
    @endif
    @if (session('delete'))
        <div class="alert alert-success mt-3">
            {{ session('delete') }}
        </div>
    @endif

    <table class="table mt-2">
        <thead>
            <tr class="bg-danger text-white">
                <th class="text-white" scope="col">No</th>
                <th class="text-white" scope="col">Name</th>
                <th class="text-white" scope="col">Department</th>
                <th class="text-white" scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @if ($searches->isEmpty())
                <tr>
                    <td>{{ $search }} not found</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @else
                @foreach ($searches as $search)
                    <tr>
                        <td class="col-1">{{ $id++ }}</td>
                        <td class="col-4">{{ $search->name }}</td>
                        @if ($search->roleID == 2)
                            <td class="col-3">IT Internal Business Process Application Head Division</td>
                        @endif
                        @if ($search->roleID == 3 || $search->roleID == 7)
                            <td class="col-3">IT Customer Relationship Management</td>
                        @endif
                        @if ($search->roleID == 4 || $search->roleID == 8)
                            <td class="col-3">IT Branch Delivery System</td>
                        @endif
                        @if ($search->roleID == 5 || $search->roleID == 9)
                            <td class="col-3">IT Micro and Retail Core Loan System</td>
                        @endif
                        @if ($search->roleID == 6 || $search->roleID == 10)
                            <td class="col-3">IT Internal Application</td>
                        @endif
                        @can('Admin')
                        <td class="col-2">
                            <a class="btn btn-primary" href="/admin/{{ $search->username }}/edit">Edit Profile</a>
                            <form action="/admin/{{$search->username}}/delete" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Are you sure want to delete this user?')"
                                class="btn btn-danger">Delete User</button>
                            </form>
                        </td>
                        @endcan
                        @cannot('Admin')
                            <td class="col-1"><a class="btn btn-primary" href="/user/{{$search->username}}/about">Detail</a></td>
                        @endcannot
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $searches->appends(\Request::except('page'))->render() !!}
@endsection
