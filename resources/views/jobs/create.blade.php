@extends('layout')

@section('title')
Workopia | Create Job
@endsection

@section('content')
<h1>Create New Job</h1>
<form action="/jobs" method="POST">

    {{--@csrf to avoid cross site attacks --}}
    @csrf

    <input type="text" name="title" placeholder="title">
    <input type="text" name="description" placeholder="description">
    <button type="submit">submit</button>
@endsection
