<x-layout>
    <x-slot name="title">Workopia | Jobs</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse ($jobs as $job)
        <x-job-card :job="$job" />
        @empty
        <li>No jobs available...</li>
        @endforelse
    </div>

    {{-- pagination navigation links --}}
    {{$jobs->links()}}

</x-layout>
