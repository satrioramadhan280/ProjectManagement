<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['line']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', {!! json_encode($monthName) !!});

        data.addColumn('number', 'Customer Relationship Management');
        data.addColumn('number', 'Branch Delivery System');
        data.addColumn('number', 'Micro and Core Loan System');
        data.addColumn('number', 'Internal Application');

        data.addRows([
            // [1,  37.8, 80.8, 41.8, 99],
            // [2,  37.8, 80.8, 41.8, 99],
            // [3,  37.8, 80.8, 41.8, 99],
            // [4,  37.8, 80.8, 41.8, 99],
            // [5,  37.8, 80.8, 41.8, 99],
            {!! json_encode($day7) !!},
            {!! json_encode($day6) !!},
            {!! json_encode($day5) !!},
            {!! json_encode($day4) !!},
            {!! json_encode($day3) !!},
            {!! json_encode($day2) !!},
            {!! json_encode($day1) !!}
        ]);

        var options = {
            chart: {
                title: '',
                // subtitle: ''
            },
            width: 900,
            height: 500,
            axes: {
                x: {
                    0: {
                        side: 'top'
                    }
                }
            }
        };

        var chart = new google.charts.Line(document.getElementById('line_top_x'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }
</script>

<style>
    .normal-text {
        text-decoration: none;
        color: black;
    }

    .hover_image {
        transition: box-shadow 0.2s ease-in-out;

    }

    .hover_image:hover {

        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: center;
    }

</style>

@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="d-flex">
        <h1>Hello, {{ Auth::user()->name }}</h1>
    </div>
    <hr>
    {{-- Chart Active Users --}}
    @can('Admin')
        <div class="d-flex justify-content-center border rounded p-5 mt-3">
            <div class="d-flex flex-column text-center">
                <h3>Total Active Users in the Past 7 Days</h3>
                <div id="line_top_x" style="width: 900px; height: 500px" class="mt-4 "></div>
            </div>
        </div>
    @endcan
    @cannot('Admin')
        <div class="d-block mt-3">
            @can('HDept1')<h4>On Going Projects at IT Customer Relationship Management</h4>@endcan
            @can('HDept2')<h4>On Going Projects at IT Branch Delivery System</h4>@endcan
            @can('HDept3')<h4>On Going Projects at IT Micro and Retail Core Loan System</h4>@endcan
            @can('HDept4')<h4>On Going Projects at IT Internal Application</h4>@endcan
            @canany(['MDept1', 'MDept2', 'MDept3', 'MDept4'])
                <h4>Your On Going Projects</h4>
            @endcanany

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
                    @can('HDept1')
                        @if ($projectsDept1->isEmpty())
                            <td>There are no on going projects</td>
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
                    @endcan
                    @can('HDept2')
                         @if ($projectsDept1->isEmpty())
                            <td>There are no on going projects</td>
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
                    @endcan
                    @can('HDept3')
                         @if ($projectsDept1->isEmpty())
                            <td>There are no on going projects</td>
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
                    @endcan
                    @can('HDept4')
                         @if ($projectsDept1->isEmpty())
                            <td>There are no on going projects</td>
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
                    @endcan
                    @can('MDept1')
                        @if ($onProjectsDept1->isEmpty())
                            <td>There are no on going projects</td>
                        @else
                        @foreach ($onProjectsDept1 as $project)
                            <tr>
                                <td class="col-6">{{ $project->title }}</td>
                                <td class="col-2">{{ $project->status->name }}</td>
                                <td class="col-3">{{ $project->endDate }}</td>
                                <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}">Detail
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    @endcan
                    @can('MDept2')
                         @if ($onProjectsDept2->isEmpty())
                            <td>There are no on going projects</td>
                        @else
                        @foreach ($onProjectsDept2 as $project)
                            <tr>
                                <td class="col-6">{{ $project->title }}</td>
                                <td class="col-2">{{ $project->status->name }}</td>
                                <td class="col-3">{{ $project->endDate }}</td>
                                <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}">Detail
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    @endcan
                    @can('MDept3')
                         @if ($onProjectsDept3->isEmpty())
                            <td>There are no on going projects</td>
                        @else
                        @foreach ($onProjectsDept3 as $project)
                            <tr>
                                <td class="col-6">{{ $project->title }}</td>
                                <td class="col-2">{{ $project->status->name }}</td>
                                <td class="col-3">{{ $project->endDate }}</td>
                                <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$project->id], 'tasks') }}">Detail
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    @endcan
                    @can('MDept4')
                         @if ($onProjectsDept4->isEmpty())
                            <td>There are no on going projects</td>
                        @else
                        @foreach ($onProjectsDept4 as $project)
                            <tr>
                                <td class="col-6">{{ $project->title }}</td>
                                <td class="col-2">{{ $project->status->name }}</td>
                                <td class="col-3">{{ $project->endDate }}</td>
                                <td><a class="btn btn-primary" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}">Detail
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    @endcan
                </tbody>
            </table>
        </div>
    @endcannot
@endsection
