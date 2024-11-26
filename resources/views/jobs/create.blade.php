<x-layout>
    <x-slot name="title">Workopia | Create Job</x-slot>
    <h1>Create New Job</h1>
    <form action="/jobs" method="POST">

        {{--@csrf to avoid cross site attacks --}}
        @csrf

        <input type="text" name="title" placeholder="title">
        <input type="text" name="description" placeholder="description">
        <button type="submit">submit</button>
</x-layout>
