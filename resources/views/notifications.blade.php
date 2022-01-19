

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
<h4>Notifications</h4>
<hr>
<table class="table">
    <thead>
        <tr class="bg-danger text-white">
            {{-- <th scope="col">No</th> --}}
            <th scope="col">Title</th>
            <th scope="col">Project</th>
            <th scope="col">Time</th>
            <th scope="col">Action</th>
            {{-- <th scope="col">Read Status</th> --}}
        </tr>
    </thead>
    <tbody class="mt-3">
        <div class="d-flex justify-content-end"><a class="btn btn-primary"
            href=""></a></div>
        @foreach ($notifications as $notification)
            @if ($notification->notification_type_id == 1)
                <tr>
                    <td class="col-4">You have been Assigned to Project</td>
                    <td class="col-4">{{$projects[$notification->assign_project_id-1]->title}}</td>
                    <td class="col-2">{{$notification->created_at}}</td>
                    <td class="col-1"><a class="btn btn-primary"
                        href="{{ route('project_detail_view', [$projects[$notification->assign_project_id-1]->id, 'tasks']) }}">Detail
                    </td>
                    {{-- <td class="col-4 align-items-center bg-warning"></td> --}}
                    {{-- <td class="col-4 align-items-center "><div class="d-flex justify-content-center"><a class="btn btn-primary"
                        href="">Mark</a></div></td> --}}
                    
                </tr>
            @elseif($notification->notification_type_id == 2)
                <tr>
                    <td class="col-4">You have been Assigned to Task <span class="font-weight-bold">"{{$tasks[$notification->assign_task_id-1]->name}}"</span></td>
                    <td class="col-4">{{$projects[$tasks[$notification->assign_task_id-1]->project_id-1]->title}}</td>
                
                    <td class="col-2">{{$notification->created_at}}</td>
                    <td class="col-1"><a class="btn btn-primary"
                        href="{{ route('project_detail_view', [$projects[$tasks[$notification->assign_task_id-1]->project_id-1]->id, 'tasks']) }}">Detail</a>
                    </td>
                    {{-- <td class="col-4 align-items-center "><div class="d-flex justify-content-center"><span data-feather="check"></span></div></td> --}} --}}
                    
                </tr>
            @elseif($notification->notification_type_id == 3)
                <tr>
                    <td class="col-4">You have been Removed from Project</td>
                    <td class="col-4">{{$projects[$notification->assign_project_id-1]->title}}</td>
                    <td class="col-2">{{$notification->created_at}}</td>
                    <td class="col-1"><a class="btn btn-primary"
                        href="{{ route('project_detail_view', [$projects[$notification->assign_project_id-1]->id, 'tasks']) }}">Detail
                    </td>
                    {{-- <td class="col-4 align-items-center "><div class="d-flex justify-content-center"><a class="btn btn-primary"
                        href="">Mark</a></div></td> --}}
                    
            </tr>
            @endif
        @endforeach
        
    </tbody>
</table>
@endsection
