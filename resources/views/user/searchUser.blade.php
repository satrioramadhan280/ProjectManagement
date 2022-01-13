@extends('layouts.app')

@section('title')
    search for '{{$search}}'
@endsection

@section('content')
    <h4>search for '{{$search}}'</h4>
    <div class="d-inline">
        @can('Admin')
            <a href="{{ url('/admin/create') }}" class="btn btn-primary mb-3">Add Employee</a>
        @endcan
        <form class="d-flex" method="GET" action="/searchUser">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search"
                value="{{ old('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
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
    @if ($searches->isEmpty())
        <h3>{{ $search }} not found</h3>
    @else    
        <table class="table mt-2">
            <thead>
                <tr class="bg-danger text-white">
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Name</th>
                    <th class="text-white" scope="col">Division
                        <select class="dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" name=""
                            id=""><span class="sr-only">Toggle Dropdown</span></select>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <option value="" class="dropdown-item">All</option>
                            <option value="" class="dropdown-item">IT Customer Relationship Management</option>
                            <option value="" class="dropdown-item">IT Branch Delivery System</option>
                            <option value="" class="dropdown-item">IT Micro and Retail Core Loan System</option>
                            <option value="" class="dropdown-item">IT Internal Application</option>
                        </div>
                    </th>
                    <th class="text-white" scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($searches as $search)
                    <tr>
                        <td class="col-1">{{ $id++ }}</td>
                        <td class="col-6">{{ $search->name }}</td>
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
                        <td><a class="btn btn-primary" href="/admin/{{ $search->username }}/edit">Edit Profile</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $searches->appends(\Request::except('page'))->render() !!}
    @endif
@endsection
