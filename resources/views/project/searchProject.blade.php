@extends('layouts.app')

@section('title')
    search for '{{ $search }}'
@endsection

@section('content')
    <h4 class="mb-2 mt-2">Search for '{{ $search }}'</h4>
    <hr>
    <div class="d-inline">
        @canany(['HDept1', 'HDept2', 'HDept3', 'HDept4'])
            <a id='addProjectbtn' href="{{ route('add_project_view') }}" class="btn btn-primary"><span data-feather="file"></span> Add Project</a>
        @endcanany
        <div class="d-block">
            <form class="d-flex flex-row justify-content-start align-items-start" method="GET" action="{{ route('searchProject') }}">
                <div class="flex-fill pt-2 pr-2 pb-2">
                    <input class="form-control mr-2 mb-2" type="search" placeholder="Search by title" aria-label="Search" name="search" value="{{ request()->query('search') }}">
                    <div class="w-25">
                        <select class="form-select" name="filterStatus" aria-label="Default select example">
                            <option value="">Filter Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" @if(request()->query('filterStatus') == $status->id) selected @endif>{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="pt-2 pr-2 pb-2">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
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
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Department</th>
                <th scope="col">Status</th>
                <th scope="col">End Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($searches->isEmpty())
                <tr>
                    <td>{{ $search }} not found</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @else
                @foreach ($searches as $search)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ $search->title }}</td>
                        @if ($search->deptID == 3)
                            <td class="col-3">IT Customer Relationship Management</td>
                        @endif
                        @if ($search->deptID == 4)
                            <td class="col-3">IT Branch Delivery System</td>
                        @endif
                        @if ($search->deptID == 5)
                            <td class="col-3">IT Micro and Retail Core Loan System</td>
                        @endif
                        @if ($search->deptID == 6)
                            <td class="col-3">IT Internal Application</td>
                        @endif
                        <td>{{ $search->status->name }}</td>
                        <td>{{ $search->endDate }}</td>
                        <td>
                            <div class="d-flex flex-row">
                                <div class="col-sm-auto d-flex flex-row">
                                    <form method="GET" action="{{ route('download_file') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type='hidden' name="filePath" value="{{ $search->sysRequirements }}">
                                            {{-- <input  class=""> --}}

                                            {{-- <a type="submit"  value="Download"></a> --}}

                                            <button type="submit" class="" value="Download" style="border: none;
                                            background: none;"><span data-feather="download"></span></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-auto">
                                    <a class="text-decoration-none" href="{{ route('project_detail_view', [$search->id, 'gantt_chart']) }}" style="color: black"><span data-feather="eye"></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {!! $searches->appends(\Request::except('page'))->render() !!}

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
