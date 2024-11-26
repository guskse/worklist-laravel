@extends('layout')

@section('title')
Workopia | Jobs
@endsection

@section('content')
<h1>Jobs Available:</h1>
<ul>
    @forelse ($jobs as $job)
    <li>{{$job}}</li>
    @empty
    <li>No jobs available...</li>
    @endforelse
</ul>
@endsection