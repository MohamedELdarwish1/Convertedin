@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="d-flex justify-content-between mb-4">
        <h3>statistics List</h3>
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
            <th>User Name</th>
            <th>num_of_tasks</th>

        </tr>
        </thead>
        <tbody>

        @foreach($statistics as $statistic)

            <tr>
                <th>{{ $statistic->id }}</th>
                <td>{{ $statistic->user_name }}</td>

                <td>{{ $statistic->num_of_tasks }}</td>

            </tr>
        @endforeach

        </tbody>
    </table>


</div>
@endsection
