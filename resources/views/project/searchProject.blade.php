@extends('layouts.app')

@section('title')
    search for '{{ $search }}'
@endsection

@section('content')
    @can('HDept1')<h4>IT Customer Relationship Management Project's List</h4>@endcan
    @can('HDept2')<h4>IT Branch Delivery System Project's List</h4>@endcan
    @can('HDept3')<h4>IT Micro and Retail Core Loan System Project's List</h4>@endcan
    @can('HDept4')<h4>IT Internal Application Project's List</h4>@endcan
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
                        <td>{{ $search->status }}</td>
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
