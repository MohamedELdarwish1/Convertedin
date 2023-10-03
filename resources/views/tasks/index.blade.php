@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="d-flex justify-content-between mb-4">
        <h3>tasks List</h3>
        {{-- <a class="btn btn-success btn-sm" href="{{route('create')}}">Create New</a> --}}
    </div>

    @if(session()->has('success'))
        <label class="alert alert-success w-100">{{session('success')}}</label>
    @elseif(session()->has('error'))
        <label class="alert alert-danger w-100">{{session('error')}}</label>
    @endif

    <table class="table table-striped">
        <thead class="table-light">
        <tr>
            <th>#</th>
            <th>title</th>
            <th>description</th>
            <th>Assigned name</th>
            <th>Admin name</th>
        </tr>
        </thead>
        <tbody>

        @foreach($tasks as $task)
            <tr>
                <th>{{ $task->id }}</th>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->user_name }}</td>
                <td>{{ $task->admin_name }}</td>

            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-between">

        {{ $tasks->links() }}
    </div>
</div>
@endsection
