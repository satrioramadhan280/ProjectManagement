@extends('layouts.app')


@can('Admin')@section('title')User List @endsection @endcan
@can('HDiv')@section('title')IT Internal Business Process Application @endsection @endcan
@can('HDept1')@section('title')IT Customer Relationship Management @endsection @endcan
@can('HDept2')@section('title')IT Branch Delivery System @endsection @endcan
@can('HDept3')@section('title')IT Micro and Retail Core Loan System @endsection @endcan
@can('HDept4')@section('title')IT Internal Application @endsection @endcan

@section('content')
    @can('Admin')<h4 class="mb-3">Users List</h4>@endcan
    @can('HDiv')<h4 class="mb-3">IT Internal Business Process Application Users List</h4>@endcan
    @can('HDept1')<h4 class="mb-3">IT Customer Relationship Management Users List</h4>@endcan
    @can('HDept2')<h4 class="mb-3">IT Branch Delivery System Users List</h4>@endcan
    @can('HDept3')<h4 class="mb-3">IT Micro and Retail Core Loan System Users List</h4>@endcan
    @can('HDept4')<h4 class="mb-3">IT Internal Application Users List</h4>@endcan

    <label for="">Department: All</label>
    <a class="btn btn-primary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Filter Department
    </a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="/user/index">All</a>
        @foreach ($roles as $role)
            @if ($role->id == 3)
                <a class="dropdown-item" href="/department/{{ $role->id }}">IT Customer Relationship Management</a>
            @endif
            @if ($role->id == 4)
                <a class="dropdown-item" href="/department/{{ $role->id }}">IT Branch Delivery System</a>
            @endif
            @if ($role->id == 5)
                <a class="dropdown-item" href="/department/{{ $role->id }}">IT Micro and Retail Core Loan System</a>
            @endif
            @if ($role->id == 6)
                <a class="dropdown-item" href="/department/{{ $role->id }}">IT Internal Application</a>
            @endif
        @endforeach
    </div>
    <div class="d-inline">
        <form class="d-flex" method="GET" action="/searchUser">
            <input class="form-control mr-2 mt-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </div>
    <table class="table mt-3">
        <thead class="bg-danger">
            <tr>
                <th class="text-white" scope="col">No</th>
                <th class="text-white" scope="col">Name</th>
                <th class="text-white" scope="col"> Department</th>
                <th class="text-white" scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @canany(['Admin', 'HDiv'])
                @foreach ($users as $user)
                    <tr>
                        <td class="col-1">{{ $id++ }}</td>
                        <td class="col-6">{{ $user->name }}</td>
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
                    </tr>
                @endforeach
            </tbody>
        @endcan
        @can('HDept1')
            @foreach ($dept1 as $user)
                <tr>
                    <td class="col-1">{{ $id++ }}</td>
                    <td class="col-5">{{ $user->name }}</td>

                </tr>
            @endforeach
            </tbody>
        @endcan
        @can('HDept2')
            @foreach ($dept2 as $user)
                <tr>
                    <td class="col-1">{{ $id }}</td>
                    <td class="col-5">{{ $user->name }}</td>
                </tr>
            @endforeach
            </tbody>
        @endcan
        @can('HDept3')
            @foreach ($dept3 as $user)
                <tr>
                    <td class="col-1">{{ $id }}</td>
                    <td class="col-5">{{ $user->name }}</td>
                </tr>
            @endforeach
        @endcan
        </tbody>
        @can('HDept4')
            @foreach ($dept4 as $user)
                <tr>
                    <td class="col-1">{{ $id }}</td>
                    <td class="col-5">{{ $user->name }}</td>
                </tr>
            @endforeach
            </tbody>
        @endcan
    </table>

    @canany(['Admin', 'HDiv']){!! $users->appends(\Request::except('page'))->render() !!}@endcanany
        @can('HDept1'){!! $dept1->appends(\Request::except('page'))->render() !!}@endcan
            @can('HDept2'){!! $dept2->appends(\Request::except('page'))->render() !!}@endcan
                @can('HDept3'){!! $dept3->appends(\Request::except('page'))->render() !!}@endcan
                    @can('HDept4'){!! $dept4->appends(\Request::except('page'))->render() !!}@endcan


                    @endsection
