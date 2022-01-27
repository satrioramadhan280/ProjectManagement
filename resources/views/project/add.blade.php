@extends('layouts.app')

@section('title')
    Add Project
@endsection

@section('content')
    <h4>Add Project</h4>
    <hr>
    <form id='addProjectForm' action="{{ route('add_project') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="projectTitle" class="form-label">Project Title</label>
            <input type="text" class="form-control @error('projectTitle') is-invalid @enderror" placeholder="Input Project Title [min. 3 characters]" name="projectTitle"
                value="{{ old('projectTitle') }}">
            @error('projectTitle')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="projectSR" class="form-label">Project SR <span class="text-danger">*pdf only</span></label> 
            <input class="form-control  @error('projectSR') is-invalid @enderror" type="file" name="projectSR" id="projectSR">
            @error('projectSR')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
        </div>
        <div class="mb-3">
            <label for="startDate" class="form-label">Start Date</label>
            <input class="form-control @error('startDate') is-invalid @enderror" type="date" name="startDate" value="{{$today}}">
            @error('startDate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="endDate" class="form-label">End Date</label>
            <input class="form-control @error('endDate') is-invalid @enderror" type="date" name="endDate" value="{{$tmrw}}">
            @error('endDate')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
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
