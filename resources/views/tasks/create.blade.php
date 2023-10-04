@extends('layouts.layout')

@section('content')

    {{-- <div class="d-flex justify-content-between mb-4">
        <h3>Create task</h3>
        <a class="btn btn-success btn-sm" href="{{ route('index') }}">List tasks</a>
    </div> --}}

    @if(session()->has('success'))
        <label class="alert alert-success w-100">{{session('success')}}</label>
    @elseif(session()->has('error'))
        <label class="alert alert-danger w-100">{{session('error')}}</label>
    @endif

    <form action="{{ route('store') }}" method="POST">

        @csrf
        <div class="form-group">
            <label>Admin Name</label>
           <select name="assigned_by_id" class="form-control" >
            @foreach ($admins as $admin )
            <option id="{{$admin->id}}" value="{{$admin->id}}" >{{$admin->name}}</option>
            @endforeach
           </select>
        </div>
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" placeholder="Title">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="5" placeholder="task description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Assigned User </label>
           <select name="assigned_to_id" class="form-control" >
            @foreach ($users as $user )
            <option id="{{$user->id}}" value="{{$user->id}}" >{{$user->name}}</option>
            @endforeach
           </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
