@extends('layouts.app')

@section('title')
    @can('HDept1')IT Customer Relationship Management Project's List>@endcan
    @can('HDept2')IT Branch Delivery System Project's List>@endcan
    @can('HDept3')IT Micro and Retail Core Loan System Project's List>@endcan
    @can('HDept4')IT Internal Application Project's List>@endcan
@endsection

@section('content')
    @canany(['HDept1', 'MDept1'])<h4>IT Customer Relationship Management Project's List</h4>@endcan
    @canany(['HDept2', 'MDept2'])<h4>IT Branch Delivery System Project's List</h4>@endcan
    @canany(['HDept3', 'MDept3'])<h4>IT Micro and Retail Core Loan System Project's List</h4>@endcan
    @canany(['HDept4', 'MDept4'])<h4>IT Internal Application Project's List</h4>@endcan

    @canany(['HDept1', 'HDept2', 'HDept3', 'HDept4'])
        <a id='addProjectbtn' data-href="{{ route('add_project_view') }}" class="btn btn-primary"><span data-feather="file"></span> Add Project</a>
    @endcanany

    <form class="d-flex mt-3" method="GET" action="{{route('searchProject')}}">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search"
            value="{{ old('search') }}">
        <button class="btn btn-primary" type="submit">Search</button>
    </form>
    <div class="mt-3">
        <table class="table mt-2">
            <thead>
                <tr class="bg-danger text-white">
                    {{-- <th scope="col">No</th> --}}
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @canany(['HDept1', 'MDept1'])
                    @if ($projectsDept1->isEmpty())
                        <h4>There are no projects available</h4>
                    @else
                    @foreach ($projectsDept1 as $project)
                        <tr>
                            <td class="col-6">{{ $project->title }}</td>
                            <td class="col-2">{{ $project->status->name }}</td>
                            <td class="col-3">{{ $project->endDate }}</td>
                            <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}">Detail
                            </td>
                        </tr>
                    @endforeach
                    @endif
                @endcanany
                @canany(['HDept2', 'MDept2'])
                     @if ($projectsDept1->isEmpty())
                        <h4>There are no projects available</h4>
                    @else
                    @foreach ($projectsDept2 as $project)
                        <tr>
                            <td class="col-6">{{ $project->title }}</td>
                            <td class="col-2">{{ $project->status->name }}</td>
                            <td class="col-3">{{ $project->endDate }}</td>
                            <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}">Detail
                            </td>
                        </tr>
                    @endforeach
                    @endif
                @endcanany
                @canany(['HDept3', 'MDept3'])
                     @if ($projectsDept1->isEmpty())
                        <h4>There are no projects available</h4>
                    @else
                    @foreach ($projectsDept3 as $project)
                        <tr>
                            <td class="col-6">{{ $project->title }}</td>
                            <td class="col-2">{{ $project->status->name }}</td>
                            <td class="col-3">{{ $project->endDate }}</td>
                            <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}">Detail
                            </td>
                        </tr>
                    @endforeach
                    @endif
                @endcanany
                @canany(['HDept4', 'MDept4'])
                     @if ($projectsDept1->isEmpty())
                        <h4>There are no projects available</h4>
                    @else
                    @foreach ($projectsDept4 as $project)
                        <tr>
                            <td class="col-6">{{ $project->title }}</td>
                            <td class="col-2">{{ $project->status->name }}</td>
                            <td class="col-3">{{ $project->endDate }}</td>
                            <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}">Detail
                            </td>
                        </tr>
                    @endforeach
                    @endif
                @endcanany
            </tbody>
        </table>
        {{-- @else
    <h4>There are no projects available</h4>
@endif --}}

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
