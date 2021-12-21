@extends('layouts.app')

@section('title')
{{$task->name}}
@endsection

@section('content')
<h1>{{ $task->name }}</h1>





<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$task->name}}</td>
            <td>{{$task->description}}</td>
        </tr>
    </tbody>
</table>



<script>
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
})

</script>
@endsection
