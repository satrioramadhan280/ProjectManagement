@extends('layouts.app')

@section('title')
Add Project
@endsection

@section('content')
<h4>Add Project</h4>

<form id='addProjectForm' action="{{route('add_project')}}" method="POST" enctype="multipart/form-data">
    @csrf

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="mb-3">
      <label for="projectTitle" class="form-label">Project Title</label>
      <input type="text" class="form-control" name="projectTitle" value="{{ old('projectTitle') }}">
    </div>
    <div class="mb-3">
        <label for="projectSR" class="form-label">Project SR</label>
        <input class="form-control" type="file" name="projectSR">
    </div>
    <div class="mb-3">
        <label for="startDate" class="form-label">Start Date</label>
        <input class="form-control" type="date" name="startDate">
    </div>
    <div class="mb-3">
        <label for="endDate" class="form-label">End Date</label>
        <input class="form-control" type="date" name="endDate">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

{{-- <script>
    $('#addProjectForm').on('submit', function (e) {
        e.preventDefault();
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const DATA = new FormData(this);
        const METHOD = $(this).attr('method');
        const URL = $(this).attr('data-action');
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            type: METHOD,
            url: URL,
            data: DATA,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response){
                console.log(response);
            },
            statusCode: {
                200: function (response){
                    window.location.replace("http://localhost:8000/projects/index");
                },
                422: function(response){
                    const errors = response.responseJSON.errors;

                    $('#addProjectForm .alert-danger').html('');
                    $.each(errors, function(key, value){

                        $('#addProjectForm .alert-danger').append('<li>'+value+'</li>');
                        $('#addProjectForm .alert-danger').show();

                    });

                }
            }
        });
    });
</script> --}}

@endsection
