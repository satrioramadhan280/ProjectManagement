@extends('layouts.app')

@section('title')
    @can('HDiv')IT Internal Business Process Application Project's List @endcan
    @canany(['HDept1', 'MDept1'])IT Customer Relationship Management Project's List @endcanany
    @canany(['HDept2', 'MDept2'])IT Customer Relationship Management Project's List @endcanany
    @canany(['HDept3', 'MDept3'])IT Branch Delivery System Project's List @endcanany
    @canany(['HDept3', 'MDept3'])IT Micro and Retail Core Loan System Project's List @endcanany
    @canany(['HDept4', 'MDept4'])IT Internal Application Project's List @endcanany
@endsection

@section('content')
    @can('HDiv')<h4>IT Internal Business Process Application Project's List</h4>@endcan
    @canany(['HDept1', 'MDept1'])<h4>IT Customer Relationship Management Project's List</h4>@endcan
    @canany(['HDept2', 'MDept2'])<h4>IT Branch Delivery System Project's List</h4>@endcan
    @canany(['HDept3', 'MDept3'])<h4>IT Micro and Retail Core Loan System Project's List</h4>@endcan
    @canany(['HDept4', 'MDept4'])<h4>IT Internal Application Project's List</h4>@endcan
    <hr>

    <div class="d-inline">
        <div class="dropdown show d-inline">
            <label for="">Status: {{ $status->name }}</label>
            <a class="btn btn-primary dropdown-toggle" href="{{ route('projects') }}" role="button" id="dropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter Status
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="{{ route('projects') }}">All</a>
                @foreach ($statuses as $s)
                    <a class="dropdown-item" href="{{ route('projectStatus', $s->id) }}">{{ $s->name }}</a>
                @endforeach
            </div>
            @canany(['HDept1', 'HDept2', 'HDept3', 'HDept4'])
                <a id='addProjectbtn' href="{{ route('add_project_view') }}" class="btn btn-primary"><span data-feather="file"></span> Add Project</a>
            @endcanany
        </div>
        <form class="d-flex mt-3" method="GET" action="{{ route('searchProject') }}">
            <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" name="search"
                value="{{ old('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </div>
    <div class="mt-3">
        <table class="table mt-2">
            <thead>
                <tr class="bg-danger text-white">
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Department</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @can('HDiv')
                    @if ($projectsDiv->isEmpty())
                        <tr>
                            <td>There are no projects available</td>
                            <td></td><td></td><td></td><td></td><td></td>
                        </tr>
                    @else
                        @foreach ($projectsDiv as $project)
                            <tr>
                                <td class="col-1">{{ $id++ }}</td>
                                <td class="col-4">{{ $project->title }}</td>
                                @if ($project->deptID == 3)
                                    <td class="col-3">IT Customer Relationship Management</td>
                                @endif
                                @if ($project->deptID == 4)
                                    <td class="col-3">IT Branch Delivery System</td>
                                @endif
                                @if ($project->deptID == 5)
                                    <td class="col-3">IT Micro and Retail Core Loan System</td>
                                @endif
                                @if ($project->deptID == 6)
                                    <td class="col-3">IT Internal Application</td>
                                @endif
                                <td class="col-2">{{ $project->status->name }}</td>
                                <td class="col-3">{{ $project->endDate }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-auto">
                                            <form method="GET" action="{{ route('download_file') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <input type='hidden' name="filePath" value="{{ $project->sysRequirements }}">
                                                    <input type="submit" class="btn btn-sm btn-primary" value="Download SR">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-sm-auto">
                                            <a class="btn btn-sm btn-primary" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}">Detail</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endcan
                @canany(['HDept1', 'MDept1'])
                    @if ($projectsDept1->isEmpty())
                        <td>There are no projects available</td>
                        <td></td><td></td><td></td><td></td><td></td>
                        @else
                            @foreach ($projectsDept1 as $project)
                                <tr>
                                    <td class="col-1">{{ $id1++ }}</td>
                                    <td class="col-4">{{ $project->title }}</td>
                                    @if ($project->deptID == 3)
                                        <td class="col-3">IT Customer Relationship Management</td>
                                    @endif
                                    <td class="col-2">{{ $project->status->name }}</td>
                                    <td class="col-3">{{ $project->endDate }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-auto">
                                                <form method="GET" action="{{ route('download_file') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type='hidden' name="filePath" value="{{ $project->sysRequirements }}">
                                                        <input type="submit" class="btn btn-sm btn-primary" value="Download SR">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-sm-auto">
                                                <a class="btn btn-sm btn-primary" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}">Detail</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    @endif
                @endcanany
                @canany(['HDept2', 'MDept2'])
                    @if ($projectsDept2->isEmpty())
                        <td>There are no projects available</td>
                        <td></td><td></td><td></td><td></td><td></td>
                        @else
                            @foreach ($projectsDept2 as $project)
                                <tr>
                                    <td class="col-1">{{ $id2++ }}</td>
                                    <td class="col-4">{{ $project->title }}</td>
                                    @if ($project->deptID == 4)
                                        <td class="col-3">IT Branch Delivery System</td>
                                    @endif
                                    <td class="col-2">{{ $project->status->name }}</td>
                                    <td class="col-3">{{ $project->endDate }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-auto">
                                                <form method="GET" action="{{ route('download_file') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type='hidden' name="filePath" value="{{ $project->sysRequirements }}">
                                                        <input type="submit" class="btn btn-sm btn-primary" value="Download SR">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-sm-auto">
                                                <a class="btn btn-sm btn-primary" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}">Detail</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    @endif
                @endcanany
                @canany(['HDept3', 'MDept3'])
                    @if ($projectsDept3->isEmpty())
                        <td>There are no projects available</td>
                        <td></td><td></td><td></td><td></td><td></td>
                        @else
                            @foreach ($projectsDept3 as $project)
                                <tr>
                                    <td class="col-1">{{ $id3++ }}</td>
                                    <td class="col-4">{{ $project->title }}</td>
                                    @if ($project->deptID == 5)
                                        <td class="col-3">IT Micro and Retail Core Loan System</td>
                                    @endif

                                    <td class="col-2">{{ $project->status->name }}</td>
                                    <td class="col-3">{{ $project->endDate }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-auto">
                                                <form method="GET" action="{{ route('download_file') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type='hidden' name="filePath" value="{{ $project->sysRequirements }}">
                                                        <input type="submit" class="btn btn-sm btn-primary" value="Download SR">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-sm-auto">
                                                <a class="btn btn-sm btn-primary" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}">Detail</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    @endif
                @endcanany
                @canany(['HDept4', 'MDept4'])
                    @if ($projectsDept4->isEmpty())
                        <td>There are no projects available</td>
                        <td></td><td></td><td></td><td></td><td></td>
                    @else
                        @foreach ($projectsDept4 as $project)
                            <tr>
                                <td class="col-1">{{ $id4++ }}</td>
                                <td class="col-4">{{ $project->title }}</td>
                                @if ($project->deptID == 6)
                                    <td class="col-3">IT Internal Application</td>
                                @endif
                                <td class="col-2">{{ $project->status->name }}</td>
                                <td class="col-3">{{ $project->endDate }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-auto">
                                            <form method="GET" action="{{ route('download_file') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <input type='hidden' name="filePath" value="{{ $project->sysRequirements }}">
                                                    <input type="submit" class="btn btn-sm btn-primary" value="Download SR">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-sm-auto">
                                            <a class="btn btn-sm btn-primary" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}">Detail</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endcanany
            </tbody>
        </table>
        @can('HDiv') {!! $projectsDiv->appends(\Request::except('page'))->render() !!} @endcan
        @canany(['HDept1', 'MDept1']) {!! $projectsDept1->appends(\Request::except('page'))->render() !!} @endcanany
        @canany(['HDept2', 'MDept2']) {!! $projectsDept2->appends(\Request::except('page'))->render() !!} @endcanany
        @canany(['HDept3', 'MDept3']) {!! $projectsDept3->appends(\Request::except('page'))->render() !!} @endcanany
        @canany(['HDept4', 'MDept4']) {!! $projectsDept4->appends(\Request::except('page'))->render() !!} @endcanany

        <!-- Modal -->
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
