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
        <h3>Hello, {{ Auth::user()->name }}</h3>
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
            @can('HDiv')<h4>On Going Projects at IT Internal Business Process Application</h4>@endcan
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
                        <th scope="col-1">No</th>
                        <th scope="col-4">Title</th>
                        <th scope="col-3">Department</th>
                        <th scope="col-2">Status</th>
                        <th scope="col-2">Start Date</th>
                        <th scope="col-2">End Date</th>
                        <th scope="col-1" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @can('HDiv')
                        @if ($projectsDiv->isEmpty())
                            <td>There are no on going projects</td>
                        @else
                        @foreach ($projectsDiv as $project)
                            <tr>
                                <td class="col-1">{{$id++}}</td>
                                <td class="col-3">{{ $project->title }}</td>
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
                    @can('HDept1')
                        @if ($projectsDept1->isEmpty())
                            <td>There are no on going projects</td>
                        @else
                        @foreach ($projectsDept1 as $project)
                            <tr>
                                <td class="col-1">{{$id1++}}</td>
                                <td class="col-3">{{ $project->title }}</td>
                                <td class="col-3">IT Customer Relationship Management</td>
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
                    @can('HDept2')
                         @if ($projectsDept2->isEmpty())
                            <td>There are no on going projects</td>
                        @else
                        @foreach ($projectsDept2 as $project)
                            <tr>
                                <td class="col-1">{{$id2++}}</td>
                                <td class="col-3">{{ $project->title }}</td>
                                <td class="col-3">IT Branch Delivery System</td>
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
                    @can('HDept3')
                         @if ($projectsDept3->isEmpty())
                            <td>There are no on going projects</td>
                        @else
                        @foreach ($projectsDept3 as $project)
                            <tr>
                                <td class="col-1">{{$id3++}}</td>
                                <td class="col-3">{{ $project->title }}</td>
                                <td class="col-3">IT Micro and Retail Core Loan System</td>
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
                    @can('HDept4')
                         @if ($projectsDept4->isEmpty())
                            <td>There are no on going projects</td>
                        @else
                        @foreach ($projectsDept4 as $project)
                            <tr>
                                <td class="col-1">{{$id4++}}</td>
                                <td class="col-3">{{ $project->title }}</td>
                                <td class="col-3">IT Internal Application</td>
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
                    @can('MDept1')
                        @if ($onProjectsDept1->isEmpty())
                            <td>There are no on going projects</td>
                        @else
                        @foreach ($onProjectsDept1 as $project)
                            <tr>
                                <td class="col-1">{{$id5++}}</td>
                                <td class="col-3">{{ $project->title }}</td>
                                <td class="col-3">IT Customer Relationship Management</td>
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
                                            <a class="text-decoration-none" href="{{ route('project_detail_view', [$project->project_id, 'gantt_chart']) }}" style="color: black"><span data-feather="eye"></span></a>
                                        </div>
                                    </div>
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
                                <td class="col-1">{{$id6++}}</td>
                                <td class="col-3">{{ $project->title }}</td>
                                <td class="col-3">IT Branch Delivery System</td>
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
                                            <a class="text-decoration-none" href="{{ route('project_detail_view', [$project->project_id, 'gantt_chart']) }}" style="color: black"><span data-feather="eye"></span></a>
                                        </div>
                                    </div>
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
                                <td class="col-1">{{$id7++}}</td>
                                <td class="col-3">{{ $project->title }}</td>
                                <td class="col-3">IT Micro and Retail Core Loan System</td>
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
                                            <a class="text-decoration-none" href="{{ route('project_detail_view', [$project->project_id, 'gantt_chart']) }}" style="color: black"><span data-feather="eye"></span></a>
                                        </div>
                                    </div>
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
                                <td class="col-1">{{$id8++}}</td>
                                <td class="col-3">{{ $project->title }}</td>
                                <td class="col-3">IT Internal Application</td>
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
                                            <a class="text-decoration-none" href="{{ route('project_detail_view', [$project->project_id, 'gantt_chart']) }}" style="color: black"><span data-feather="eye"></span></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    @endcan
                </tbody>
            </table>
            @can('HDiv') {!! $projectsDiv->appends(\Request::except('page'))->render() !!} @endcan
            @can('HDept1') {!! $projectsDept1->appends(\Request::except('page'))->render() !!} @endcan
            @can('HDept2') {!! $projectsDept2->appends(\Request::except('page'))->render() !!} @endcan
            @can('HDept3') {!! $projectsDept3->appends(\Request::except('page'))->render() !!} @endcan
            @can('HDept4') {!! $projectsDept4->appends(\Request::except('page'))->render() !!} @endcan
            @can('MDept1') {!! $onProjectsDept1->appends(\Request::except('page'))->render() !!} @endcan
            @can('MDept2') {!! $onProjectsDept2->appends(\Request::except('page'))->render() !!} @endcan
            @can('MDept3') {!! $onProjectsDept3->appends(\Request::except('page'))->render() !!} @endcan
            @can('MDept4') {!! $onProjectsDept4->appends(\Request::except('page'))->render() !!} @endcan
        </div>
    @endcannot
@endsection
