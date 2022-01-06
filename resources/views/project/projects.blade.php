@extends('layouts.app')

@section('title')
    Projects
@endsection

@section('content')
    @can('HDept1')<h4>IT Customer Relationship Management Project's List</h4>@endcan
    @can('HDept2')<h4>IT Branch Delivery System Project's List</h4>@endcan
    @can('HDept3')<h4>IT Micro and Retail Core Loan System Project's List</h4>@endcan
    @can('HDept4')<h4>IT Internal Application Project's List</h4>@endcan

    @canany(['HDept1', 'HDept2', 'HDept3', 'HDept4'])
        <a id='addProjectbtn' data-href="{{ route('add_project_view') }}" class="btn btn-primary">Add Project</a>
    @endcanany

    <div class="mt-3">
        {{-- @can('HDept1')@if (!$projectsDept1->isEmpty())@endcan
    @can('HDept2')@if (!$projectsDept2->isEmpty())@endcan
    @can('HDept3')@if (!$projectsDept3->isEmpty())@endcan
    @can('HDept4')@if (!$projectsDept4->isEmpty())@endcan --}}
        <table class="table">
            <thead>
                <tr class="bg-danger text-white">
                    <th scope="col">Title</th>
                    <th scope="col">Project Status</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
                @can('HDept1')
                    @foreach ($projectsDept1 as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->status }}</td>
                            <td>{{ $project->endDate }}</td>
                            <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$project->id]) }}">Detail</a></td>
                        </tr>
                    @endforeach
                @endcan
                @can('HDept2')
                    @foreach ($projectsDept2 as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->status }}</td>
                            <td>{{ $project->endDate }}</td>
                            <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$project->id]) }}">Detail</a></td>
                        </tr>
                    @endforeach
                @endcan
                @can('HDept3')
                    @foreach ($projectsDept3 as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->status }}</td>
                            <td>{{ $project->endDate }}</td>
                            <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$project->id]) }}">Detail</a></td>
                        </tr>
                    @endforeach
                @endcan
                @can('HDept4')
                    @foreach ($projectsDept4 as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->status }}</td>
                            <td>{{ $project->endDate }}</td>
                            <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$project->id]) }}">Detail</a></td>
                        </tr>
                    @endforeach
                @endcan
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
