

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
    .unread-bar{
        background-color: rgba(127, 109, 214, 0.199);
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
            <th scope="col">Read Status</th>
        </tr>
    </thead>
    <tbody class="mt-3">
        <div class="d-flex justify-content-end mb-3"><a class="btn btn-primary"
            href="{{ route('markAsReadAll') }}">Mark as Read All</a></div>
        @foreach ($notifications as $notification)
            <tr class="
                @if($notification->status == 0)
                    unread-bar
                @endif
            ">
                @if ($notification->notification_type_id == 1)
                    
                        <td class="col-4">You have been Assigned to Project</td>
                        <td class="col-4">{{$projects[$notification->assign_project_id-1]->title}}</td>
                        <td class="col-2">{{$notification->created_at}}</td>
                        <td class="col-1"><a class="btn btn-primary"
                            href="{{ route('project_detail_view', [$projects[$notification->assign_project_id-1]->id, 'tasks']) }}">Detail
                        </td>
                        {{-- <td class="col-4 align-items-center bg-warning"></td> --}}
                        
                        
                    
                @elseif($notification->notification_type_id == 2)
                    
                        <td class="col-4">You have been Assigned to Task <span class="font-weight-bold">"{{$tasks[$notification->assign_task_id-1]->name}}"</span></td>
                        <td class="col-4">{{$projects[$tasks[$notification->assign_task_id-1]->project_id-1]->title}}</td>
                    
                        <td class="col-2">{{$notification->created_at}}</td>
                        <td class="col-1"><a class="btn btn-primary"
                            href="{{ route('project_detail_view', [$projects[$tasks[$notification->assign_task_id-1]->project_id-1]->id, 'tasks']) }}">Detail</a>
                        </td>
                        
                    
                @elseif($notification->notification_type_id == 3)
                    
                        <td class="col-4">You have been Removed from Project</td>
                        <td class="col-4">{{$projects[$notification->assign_project_id-1]->title}}</td>
                        <td class="col-2">{{$notification->created_at}}</td>
                        <td class="col-1"><a class="btn btn-primary"
                            href="{{ route('project_detail_view', [$projects[$notification->assign_project_id-1]->id, 'tasks']) }}">Detail
                        </td>
                @endif  
                @if ($notification->status == 0)
                    <td class="col-4 align-items-center "><div class="d-flex justify-content-center"><a class="btn btn-primary"
                        href="/notifications/mark_as_read/{{$notification->id}}">Mark</a></div></td>  
                
                @elseif($notification->status == 1)
                    <td class="col-4  "><div class="d-flex justify-content-center align-items-center"><span data-feather="check"></span></div></td> 
                
                @endif
            </tr>
                    
            
            
        @endforeach
        
    </tbody>
</table>
@endsection
