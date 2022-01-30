@extends('layouts.app')


@can('Admin')@section('title')List Users @endsection @endcan
@can('HDiv')@section('title')List Users IT Internal Business Process Application @endsection @endcan
@canany(['HDept1', 'MDept1'])@section('title')List Users IT Customer Relationship Management @endsection @endcanany
@canany(['HDept2', 'MDept2'])@section('title')List Users IT Branch Delivery System @endsection @endcanany
@canany(['HDept3', 'MDept3'])@section('title')List Users IT Micro and Retail Core Loan System @endsection @endcanany
@canany(['HDept4', 'MDept4'])@section('title')List Users IT Internal Application @endsection @endcanany

@section('content')
@can('Admin')<h4 class="mb-3">List Users</h4>@endcan
@can('HDiv')<h4 class="mb-3">List Users IT Internal Business Process Application</h4>@endcan
@canany(['HDept1', 'MDept1'])<h4 class="mb-3">List Users IT Customer Relationship Management</h4>@endcanany
@canany(['HDept2', 'MDept2'])<h4 class="mb-3">List Users IT Branch Delivery System</h4>@endcanany
@canany(['HDept3', 'MDept3'])<h4 class="mb-3">List Users IT Micro and Retail Core Loan System</h4>@endcanany
@canany(['HDept4', 'MDept4'])<h4 class="mb-3">List Users IT Internal Application</h4>@endcanany
<hr>
@if (session('create'))
<div class="alert alert-success mt-3">
    {{ session('create') }}
</div>
@endif
@if (session('update'))
<div class="alert alert-success mt-3">
    {{ session('update') }}
</div>
@endif
@if (session('delete'))
<div class="alert alert-success mt-3">
    {{ session('delete') }}
</div>
@endif
@can('Admin')
<a href="{{ url('/admin/create') }}" class="btn btn-primary"><span data-feather="user-plus"></span> Add New User</a>
@endcan
<div class="d-block">
    <form class="d-flex flex-row justify-content-start align-items-start" method="GET" action="/searchUser">
        <div class="flex-fill pt-2 pr-2 pb-2">
            <input class="form-control mr-2 mb-2" type="search" placeholder="Search by name" aria-label="Search" name="search">
            @canany(['Admin', 'HDiv'])
            <div class="w-25">
                <select class="form-select" name="filterDept" aria-label="Default select example">
                    <option value="" selected>Filter Department</option>
                    @foreach ($roles as $role)
                        @php
                            $display = $role->display;
                            $array_of_display = explode(" ", $display);
                            $slice_display = array_slice($array_of_display, 2);
                            $combined_display = implode(" ", $slice_display);
                        @endphp
                        <option value="{{ $role->id }}"> {{ $combined_display }} </option>
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
<table class="table mt-3">
    <thead class="bg-danger">
        <tr>
            <th class="text-white" scope="col">No</th>
            <th class="text-white" scope="col">Name</th>
            <th class="text-white" scope="col">Department</th>
            <th class="text-white" scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @can('Admin')
        @foreach ($users as $user)
        <tr>
            <td class="col-1">{{ $id++ }}</td>
            <td class="col-4">{{ $user->name }}</td>
            @if ($user->roleID == 2)
            <td class="col-3">Head Division</td>
            @endif
            @if ($user->roleID == 3 || $user->roleID == 7)
            <td class="col-3">IT Customer Relationship Management</td>
            @endif
            @if ($user->roleID == 4 || $user->roleID == 8)
            <td class="col-3">IT Branch Delivery System</td>
            @endif
            @if ($user->roleID == 5 || $user->roleID == 9)
            <td class="col-3">IT Micro and Retail Core Loan System</td>
            @endif
            @if ($user->roleID == 6 || $user->roleID == 10)
            <td class="col-3">IT Internal Application</td>
            @endif
            <td class="col-2">
                <a class="btn btn-primary" href="/admin/{{ $user->username }}/edit">Edit Profile</a>
                <form action="/admin/{{$user->username}}/delete" method="POST" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirm('Are you sure want to delete this user?')"
                    class="btn btn-danger">Delete User</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endcan
    @can('HDiv')
    @foreach ($div as $user)
    <tr>
        <td class="col-1">{{ $id++ }}</td>
        <td class="col-4">{{ $user->name }}</td>
        @if ($user->roleID == 2)
            <td class="col-3">Head Division</td>
        @endif
        @if ($user->roleID == 3 || $user->roleID == 7)
        <td class="col-3">IT Customer Relationship Management</td>
        @endif
        @if ($user->roleID == 4 || $user->roleID == 8)
        <td class="col-3">IT Branch Delivery System</td>
        @endif
        @if ($user->roleID == 5 || $user->roleID == 9)
        <td class="col-3">IT Micro and Retail Core Loan System</td>
        @endif
        @if ($user->roleID == 6 || $user->roleID == 10)
        <td class="col-3">IT Internal Application</td>
        @endif
        <td class="col-1"><a class="btn btn-primary" href="/user/{{ $user->username }}/about">Detail</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    @endcan
    @canany(['HDept1', 'MDept1'])
    @foreach ($dept1 as $user)
    <tr>
        <td class="col-1">{{ $id++ }}</td>
        <td class="col-5">{{ $user->name }}</td>
        @if ($user->roleID == 3 || $user->roleID == 7)
        <td class="col-3">IT Customer Relationship Management</td>
        @endif
        <td class="col-1"><a class="btn btn-primary" href="/user/{{ $user->username }}/about">Detail</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    @endcanany
    @canany(['HDept2', 'MDept2'])
    @foreach ($dept2 as $user)
    <tr>
        <td class="col-1">{{ $id }}</td>
        <td class="col-5">{{ $user->name }}</td>
        @if ($user->roleID == 4 || $user->roleID == 8)
        <td class="col-3">IT Branch Delivery System</td>
        @endif
        <td class="col-1"><a class="btn btn-primary" href="/user/{{ $user->username }}/about">Detail</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    @endcanany
    @canany(['HDept3', 'MDept3'])
    @foreach ($dept3 as $user)
    <tr>
        <td class="col-1">{{ $id }}</td>
        <td class="col-5">{{ $user->name }}</td>
        @if ($user->roleID == 5 || $user->roleID == 9)
        <td class="col-3">IT Micro and Retail Core Loan System</td>
        @endif
        <td class="col-1"><a class="btn btn-primary" href="/user/{{ $user->username }}/about">Detail</a>
        </td>
    </tr>
    @endforeach
    @endcanany
    </tbody>
    @canany(['HDept4', 'MDept4'])
    @foreach ($dept4 as $user)
    <tr>
        <td class="col-1">{{ $id }}</td>
        <td class="col-5">{{ $user->name }}</td>
        @if ($user->roleID == 6 || $user->roleID == 10)
        <td class="col-3">IT Internal Application</td>
        @endif
        <td class="col-1"><a class="btn btn-primary" href="/user/{{ $user->username }}/about">Detail</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    @endcanany
</table>

@can('Admin'){!! $users->appends(\Request::except('page'))->render() !!}@endcan
@can('HDiv'){!! $div->appends(\Request::except('page'))->render() !!}@endcan
@canany(['HDept1', 'MDept1']){!! $dept1->appends(\Request::except('page'))->render() !!}@endcanany
@canany(['HDept2', 'MDept2']){!! $dept2->appends(\Request::except('page'))->render() !!}@endcanany
@canany(['HDept3', 'MDept3']){!! $dept3->appends(\Request::except('page'))->render() !!}@endcanany
@canany(['HDept4', 'MDept4']){!! $dept4->appends(\Request::except('page'))->render() !!}@endcanany


@endsection
