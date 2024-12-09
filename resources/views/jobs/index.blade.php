<x-layout>
    <x-slot name="title">Workopia | Jobs</x-slot>

    <div class="bg-blue-900 h-24 px-4 mb-4 flex justify-center items-center rounded">
        <x-search />
    </div>


    {{-- will show a back button if user makes a query --}}
    {{-- Back button --}}
    @if(request()->has('keywords') || request()->has('location'))
    <a href="{{route('jobs.index')}}" class="bg-gray-700 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-gray-600">
        <i class="fa fa-arrow-left mr-1"></i>Back
    </a>

    @endif

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
