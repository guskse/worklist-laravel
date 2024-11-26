<x-layout>
    <x-slot name="title">Workopia | Jobs</x-slot>
    <h1>Jobs Available:</h1>
    <ul>
        @forelse ($jobs as $job)
        <li>{{$job}}</li>
        @empty
        <li>No jobs available...</li>
        @endforelse
    </ul>

</x-layout>
