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
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    @if (session('delete'))
        <div class="alert alert-success mt-3">
            {{ session('delete') }}
        </div>
    @endif

    <div class="d-inline">
        @canany(['HDept1', 'HDept2', 'HDept3', 'HDept4'])
            <a id='addProjectbtn' href="{{ route('add_project_view') }}" class="btn btn-primary"><span data-feather="file"></span> Add Project</a>
        @endcanany
        <div class="d-block">
            <form class="d-flex flex-row justify-content-start align-items-start" method="GET" action="{{ route('searchProject') }}">
                <div class="flex-fill pt-2 pr-2 pb-2">
                    <input class="form-control mr-2 mb-2" type="search" placeholder="Search by title" aria-label="Search" name="search">
                    <div class="w-25">
                        <select class="form-select" name="filterStatus" aria-label="Default select example">
                            <option value="" selected>Filter Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
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
    <div class="mt-3">
        <table class="table mt-2">
            <thead>
                <tr class="bg-danger text-white">
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Department</th>
                    <th scope="col">Status</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @can('HDiv')
                    @if ($projectsDiv->isEmpty())
                        <h4>There are no projects available</h4>
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
                                <td class="col-1">{{ $project->startDate->format('d-m-Y') }}</td>
                                <td class="col-1">{{ $project->endDate->format('d-m-Y') }}</td>
                                <td class="col-1">
                                    <div class="d-flex flex-row">
                                        <div class="col-sm-auto d-flex flex-row">
                                            <form method="GET" action="{{ route('download_file') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <input type='hidden' name="filePath" value="{{ $project->sysRequirements }}">
                                                    {{-- <input  class=""> --}}

                                                    {{-- <a type="submit"  value="Download"></a> --}}

                                                    <button type="submit" class="" value="Download" style="border: none;
                                                    background: none;"><span data-feather="download"></span></button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-sm-auto">
                                            <a class="text-decoration-none" href="{{ route('project_detail_view', [$project->id, 'gantt_chart']) }}" style="color: black"><span data-feather="eye"></span></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endcan
                @canany(['HDept1', 'MDept1'])
                    @if ($projectsDept1->isEmpty())
                        <h4>There are no projects available</h4>
                    @else
                    @foreach ($projectsDept1 as $project)
                        <tr>
                            <td class="col-1">{{$id1++}}</td>
                            <td class="col-3">{{ $project->title }}</td>
                            @if ($project->deptID == 3)
                                <td class="col-3">IT Customer Relationship Management</td>
                            @endif
                            <td class="col-2">{{ $project->status->name }}</td>
                            <td class="col-1">{{ $project->startDate->format('d-m-Y') }}</td>
                            <td class="col-1">{{ $project->endDate->format('d-m-Y') }}</td>
                            <td class="col-1">



                                <div class="d-flex flex-row">
                                    <div class="col-sm-auto d-flex flex-row">
                                        <form method="GET" action="{{ route('download_file') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type='hidden' name="filePath" value="{{ $project->sysRequirements }}">
                                                {{-- <input  class=""> --}}

                                                {{-- <a type="submit"  value="Download"></a> --}}

                                                <button type="submit" class="" value="Download" style="border: none;
                                                background: none;"><span data-feather="download"></span></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-auto">
                                        <a class="text-decoration-none" href="{{ route('project_detail_view', [$project->id, 'gantt_chart']) }}" style="color: black"><span data-feather="eye"></span></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                @endcanany
                @canany(['HDept2', 'MDept2'])
                    @if ($projectsDept2->isEmpty())
                        <h4>There are no projects available</h4>
                    @else
                    @foreach ($projectsDept2 as $project)
                        <tr>
                            <td class="col-1">{{$id2++}}</td>
                            <td class="col-3">{{ $project->title }}</td>
                            @if ($project->deptID == 4)
                                <td class="col-3">IT Branch Delivery System</td>
                            @endif
                            <td class="col-2">{{ $project->status->name }}</td>
                            <td class="col-1">{{ $project->startDate->format('d-m-Y') }}</td>
                            <td class="col-1">{{ $project->endDate->format('d-m-Y') }}</td>
                            <td class="col-1">
                                <div class="d-flex flex-row">
                                    <div class="col-sm-auto d-flex flex-row">
                                        <form method="GET" action="{{ route('download_file') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type='hidden' name="filePath" value="{{ $project->sysRequirements }}">
                                                {{-- <input  class=""> --}}

                                                {{-- <a type="submit"  value="Download"></a> --}}

                                                <button type="submit" class="" value="Download" style="border: none;
                                                background: none;"><span data-feather="download"></span></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-auto">
                                        <a class="text-decoration-none" href="{{ route('project_detail_view', [$project->id, 'gantt_chart']) }}" style="color: black"><span data-feather="eye"></span></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                @endcanany
                @canany(['HDept3', 'MDept3'])
                    @if ($projectsDept3->isEmpty())
                        <h4>There are no projects available</h4>
                    @else
                    @foreach ($projectsDept3 as $project)
                        <tr>
                            <td class="col-1">{{$id3++}}</td>
                            <td class="col-3">{{ $project->title }}</td>
                            @if ($project->deptID == 5)
                                <td class="col-3">IT Micro and Retail Core Loan System</td>
                            @endif
                            <td class="col-2">{{ $project->status->name }}</td>
                            <td class="col-1">{{ $project->startDate->format('d-m-Y') }}</td>
                            <td class="col-1">{{ $project->endDate->format('d-m-Y') }}</td>
                            <td class="col-1">
                                <div class="d-flex flex-row">
                                    <div class="col-sm-auto d-flex flex-row">
                                        <form method="GET" action="{{ route('download_file') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type='hidden' name="filePath" value="{{ $project->sysRequirements }}">
                                                {{-- <input  class=""> --}}

                                                {{-- <a type="submit"  value="Download"></a> --}}

                                                <button type="submit" class="" value="Download" style="border: none;
                                                background: none;"><span data-feather="download"></span></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-auto">
                                        <a class="text-decoration-none" href="{{ route('project_detail_view', [$project->id, 'gantt_chart']) }}" style="color: black"><span data-feather="eye"></span></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                @endcanany
                @canany(['HDept4', 'MDept4'])
                    @if ($projectsDept4->isEmpty())
                        <h4>There are no projects available</h4>
                    @else
                    @foreach ($projectsDept4 as $project)
                        <tr>
                            <td class="col-1">{{$id4++}}</td>
                            <td class="col-3">{{ $project->title }}</td>
                            @if ($project->deptID == 6)
                                <td class="col-3">IT Internal Application</td>
                            @endif
                            <td class="col-2">{{ $project->status->name }}</td>
                            <td class="col-1">{{ $project->startDate->format('d-m-Y') }}</td>
                            <td class="col-1">{{ $project->endDate->format('d-m-Y') }}</td>
                            <td class="col-1">
                                <div class="d-flex flex-row">
                                    <div class="col-sm-auto d-flex flex-row">
                                        <form method="GET" action="{{ route('download_file') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type='hidden' name="filePath" value="{{ $project->sysRequirements }}">
                                                {{-- <input  class=""> --}}

                                                {{-- <a type="submit"  value="Download"></a> --}}

                                                <button type="submit" class="" value="Download" style="border: none;
                                                background: none;"><span data-feather="download"></span></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-auto">
                                        <a class="text-decoration-none" href="{{ route('project_detail_view', [$project->id, 'gantt_chart']) }}" style="color: black"><span data-feather="eye"></span></a>
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


    @endsection
