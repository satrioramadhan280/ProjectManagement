@extends('layouts.app')

@section('title')
    search for '{{ $search }}'
@endsection

@section('content')
    @can('HDiv')<h4>IT Internal Business Process Application Project's List</h4>@endcan
    @canany(['HDept1', 'MDept1'])<h4>IT Customer Relationship Management Project's List</h4>@endcan
    @canany(['HDept2', 'MDept2'])<h4>IT Branch Delivery System Project's List</h4>@endcan
    @canany(['HDept3', 'MDept3'])<h4>IT Micro and Retail Core Loan System Project's List</h4>@endcan
    @canany(['HDept4', 'MDept4'])<h4>IT Internal Application Project's List</h4>@endcan
    <div class="d-inline">
        @canany(['HDept1', 'HDept2', 'HDept3', 'HDept4'])
            <a id='addProjectbtn' data-href="{{ route('add_project_view') }}" class="btn btn-primary mt-1"><span data-feather="file"></span> Add Project</a>
        @endcanany
        <form class="d-flex mt-2" method="GET" action="{{route('searchProject')}}">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{$search}}">
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
        <h4>{{ $search }} not found</h4>
    @else
        <h4 class="mb-2 mt-2">Search for '{{ $search }}'</h4>
        <table class="table mt-2">
            <thead>
                <tr class="bg-danger text-white">
                    <th scope="col">No</th>
                    <th scope="col" class="dropdown-toggle">Title</th>
                    <th scope="col" class="dropdown-toggle">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($searches as $search)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ $search->title }}</td>
                        <td>{{ $search->status->name }}</td>
                        <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$search->id, 'tasks']) }}">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $searches->appends(\Request::except('page'))->render() !!}
    @endif

    <div class="modal fade" id="addProjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@endsection
