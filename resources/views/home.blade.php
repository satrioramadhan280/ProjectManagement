<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', {!!json_encode($monthName)!!});
      
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
        {!!json_encode($day7)!!},
        {!!json_encode($day6)!!},
        {!!json_encode($day5)!!},
        {!!json_encode($day4)!!},
        {!!json_encode($day3)!!},
        {!!json_encode($day2)!!},
        {!!json_encode($day1)!!}
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
            0: {side: 'top'}
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
  <h1>Hello, {{Auth::user()->firstName}} {{Auth::user()->lastName}}!</h1>
</div>

{{-- Chart Active Users --}}
@can('Admin')
  <div class="d-flex justify-content-center border rounded p-5 mt-3">
    <div class="d-flex flex-column text-center">
      <h3>Total Active Users in the Past 7 Days</h3>
      <div id="line_top_x" style="width: 900px; height: 500px" class="mt-4 "></div>
    </div>

  </div>
@endcan

<div class="d-flex justify-content-center flex-column mt-3 border rounded " >
  <div class="d-flex flex-row justify-content-around m-3">
    {{-- <div class="d-flex flex-row justify-content-between bg-warning" style=" "> --}}
      @canany(['Admin', 'HDept1', 'HDept2', 'HDept3', 'HDept4'])
      <div class="hover_image d-flex flex-column justify-content-center border border-3 rounded" style="background: rgba(243, 243, 243, 0.623)">
        @can('Admin')
        <a href="{{URL('/admin/index')}}" class="normal-text" style="color: black">
        @endcan
        @canany(['HDept1', 'HDept2', 'HDept3', 'HDept4'])
        <a href="{{URL('/user/index')}}" class="normal-text" style="color: black">
        @endcanany
          <img src="{{URL::asset('/img/user-icon.png')}}" class="m-3" alt="" style="height: 200px; width: 200px">
          @can('Admin')<h3 class="text-center mb-3">Users</h3> @endcan 
          {{-- {{$TotalUsers}}  --}}
          @can('HDept1')<h3 class="text-center mb-3">Users</h3> @endcan
          @can('HDept2')<h3 class="text-center mb-3">Users</h3> @endcan
          @can('HDept3')<h3 class="text-center mb-3">Users</h3> @endcan
          @can('HDept4')<h3 class="text-center mb-3">Users</h3> @endcan
        </a>
      </div>
      @endcanany

      @can('Admin')
      <div class="hover_image d-flex flex-column justify-content-center border border-3 rounded" style="background: rgba(243, 243, 243, 0.623)">
        <a href="/department" class="normal-text" style="color: black">
          <img src="{{URL::asset('/img/department-icon.png')}}" class="m-3" alt="" style="height: 200px; width: 200px">
          {{-- <a href="{{url('/admin/index')}}" class="text-center">Users</a> --}}
          <h3 class="text-center mb-3">Department</h3>
        </a>
      </div>
      @endcan
    {{-- </div> --}}
  </div>
</div>

@can('isHDiv')
ini HDiv
@endcan

@endsection