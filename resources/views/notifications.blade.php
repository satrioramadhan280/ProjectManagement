

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
            <th scope="col">Description</th>
            <th scope="col">Project</th>
            <th scope="col">Time</th>
            <th scope="col">Action</th>
            <th scope="col">Read Status</th>
        </tr>
    </thead>
    <tbody class="mt-3">
       
            
        
        <div class="d-flex flex-row justify-content-end">
            <div class="d-flex  mb-3"><a class="btn btn-primary"
                href="{{ route('markAsReadAll') }}">Mark All as Read</a></div>
            <div class="d-flex ml-3 mb-3"><a class="btn btn-danger"
                    href="{{ route('deleteAllRead') }}">Delete All Read</a></div>
        </div>
        @if ($notifications->isEmpty())
        <td>
            There no notifications available
        </td>
        @else
        @foreach ($notifications as $notification)
            <tr class="
                @if($notification->status == 0)
                    unread-bar
                @endif
            ">
                @if ($notification->notification_type_id == 1)
                    
                        <td class="col-3">You have been Assigned to Project</td>
                        <td class="col-3">-</td>
                        <td class="col-2">{{$projects[$notification->project_id-1]->title}}</td>
                        <td class="col-2">{{$notification->created_at}}</td>
                        
                        <td class="col-1 align-items-center">
                            <a class="text-decoration-non ml-3 mt-4" style="color: black"
                            href="{{ route('project_detail_view', [$projects[$notification->project_id-1]->id, 'tasks']) }}">
                            <span data-feather="eye"  style="width: 20px; height: 20px;"></span></a></div>
                        </td>
                        {{-- <td class="col-4 align-items-center bg-warning"></td> --}}
                        
                        
                    
                @elseif($notification->notification_type_id == 2)
                    
                        <td class="col-3">You have been Assigned to Task <span class="font-weight-bold">"{{$tasks[$notification->task_id-1]->name}}"</span></td>
                        <td class="col-3">-</td>
                        <td class="col-2">{{$projects[$tasks[$notification->task_id-1]->project_id-1]->title}}</td>
                
                        <td class="col-2">{{$notification->created_at}}</td>
                        
                        <td class="col-1 align-items-center">
                            <a class="text-decoration-non ml-3 mt-4" style="color: black"
                            href="{{ route('project_detail_view', [$projects[$tasks[$notification->task_id-1]->project_id-1]->id, 'tasks']) }}">
                            <span data-feather="eye"  style="width: 20px; height: 20px;"></span></a></div>
                        </td>
                        
                    
                @elseif($notification->notification_type_id == 3)
                    
                        <td class="col-3">You have been Removed from Project</td>
                        <td class="col-3">-</td>
                        <td class="col-2">{{$projects[$notification->project_id-1]->title}}</td>
                        <td class="col-2">{{$notification->created_at}}</td>
                        <td class="col-1 align-items-center">
                            <a class="text-decoration-non ml-3 mt-4" style="color: black"
                            href="{{ route('project_detail_view', [$projects[$notification->project_id-1]->id, 'tasks']) }}">
                            <span data-feather="eye"  style="width: 20px; height: 20px;"></span></a></div>
                        </td>

                @elseif($notification->notification_type_id == 4)
            
                        <td class="col-3">Removed from Task'{{$notification->additional_description}}'</td>
                        <td class="col-3">-</td>
                        <td class="col-2">{{$projects[$notification->project_id-1]->title}}</td>
                        <td class="col-2">{{$notification->created_at}}</td>
                        <td class="col-1 align-items-center">
                            <a class="text-decoration-non ml-3 mt-4" style="color: black"
                            href="{{ route('project_detail_view', [$projects[$notification->project_id-1]->id, 'tasks']) }}">
                            <span data-feather="eye"  style="width: 20px; height: 20px;"></span></a></div>
                        </td>

                @elseif($notification->notification_type_id == 5)
            
                    <td class="col-3">New Project Created</td>
                    <td class="col-3">-</td>
                    <td class="col-2">{{$projects[$notification->project_id-1]->title}}</td>
                    <td class="col-2">{{$notification->created_at}}</td>
                    <td class="col-1 align-items-center">
                        <a class="text-decoration-non ml-3 mt-4" style="color: black"
                        href="{{ route('project_detail_view', [$projects[$notification->project_id-1]->id, 'tasks']) }}">
                        <span data-feather="eye"  style="width: 20px; height: 20px;"></span></a></div>
                    </td>

                @elseif($notification->notification_type_id == 6)
            
                    <td class="col-3">Project Deleted</td>
                    <td class="col-3">-</td>
                    <td class="col-2">{{$notification->additional_description}}</td>
                    <td class="col-2">{{$notification->created_at}}</td>
                    
                    <td class="col-1 align-items-center">
                        <a class="" disable
                        href="" disabled>
                        <span data-feather="eye"  style="width: 20px; height: 20px;"></span></a></div>
                    </td>

                @elseif($notification->notification_type_id == 7)
            
                    <td class="col-3">Project Status Updated to '<span class="font-weight-bold">{{$notification->additional_description}}</span>'</td>
                    <td class="col-3">-</td>
                    <td class="col-2">{{$projects[$notification->project_id-1]->title}}</td>
                    <td class="col-2">{{$notification->created_at}}</td>
                    
                    <td class="col-1 align-items-center">
                        <a class="text-decoration-non ml-3 mt-4" style="color: black"
                        href="{{ route('project_detail_view', [$projects[$notification->project_id-1]->id, 'tasks']) }}">
                        <span data-feather="eye"  style="width: 20px; height: 20px;"></span></a></div>
                    </td>

                @elseif($notification->notification_type_id == 8)
            
                    <td class="col-3">New Message Forum from '<span class="font-weight-bold">{{$roles[$users[$forums[$notification->forum_id-1]->user_id-1]->roleID-1]->name}}</span>'</td>
                    <td class="col-3">{{$notification->additional_description}}</td>
                    <td class="col-2">{{$projects[$forums[$notification->forum_id-1]->project_id-1]->title}}</td>
                    <td class="col-2">{{$notification->created_at}}</td>
                    
                    <td class="col-1 align-items-center">
                        <a class="text-decoration-non ml-3 mt-4" style="color: black"
                        href="{{ route('project_detail_view', [$projects[$forums[$notification->forum_id-1]->project_id-1]->id, 'forum']) }}">
                        <span data-feather="eye"  style="width: 20px; height: 20px;"></span></a></div>
                    </td>
                @elseif($notification->notification_type_id == 9)
            
                    <td class="col-3">New Forum Reply</td>
                    <td class="col-3">{{$notification->additional_description}}</td>
                    <td class="col-2">{{$projects[$forums[$notification->forum_id-1]->project_id-1]->title}}</td>
                    <td class="col-2">{{$notification->created_at}}</td>
                    
                    <td class="col-1 align-items-center">
                        <a class="text-decoration-non ml-3 mt-4" style="color: black"
                        href="{{ route('project_detail_view', [$projects[$forums[$notification->forum_id-1]->project_id-1]->id, 'forum']) }}">
                        <span data-feather="eye"  style="width: 20px; height: 20px;"></span></a></div>
                    </td>
                    
                @endif  

                @if ($notification->status == 0)
                    <td class="col-2 align-items-center "><div class="d-flex justify-content-center"><a 
                        href="/notifications/mark_as_read/{{$notification->id}}" class="text-decoration-none" style="color: rgb(0, 0, 0)"><span data-feather="circle"></span></a></div></td>  
                
                @elseif($notification->status == 1)
                    <td class="col-2 "><div class="d-flex align-items-center justify-content-center"><a class="text-decoration-none" style="color: rgb(8, 102, 0)"><span data-feather="check-circle" class=""></span></div></a></td> 
                
                @endif
            </tr> 
        @endforeach
        @endif
    </tbody>
</table>
@endsection
