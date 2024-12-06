<x-layout>
    <section class="flex flex-col md:flex-row gap-4">
        {{-- PROFILE INFO FORM --}}
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold mb-4">
                Profile Info
            </h3>

            {{-- SHOW PROFILE IMG IF THERE IS ANY --}}
            @if($user->avatar)
            <div class="mt-2 flex justify-center">
                <img class="w-64 h-64 rounded-full object-cover" src="{{asset('storage/' . $user->avatar)}}" alt="profile image"></div>
            @else
            <div class="mt-2 flex justify-center">
                <img class="w-32 h-32 rounded-full object-cover" src="{{asset('storage/avatars/default-avatar.png')}}" alt="profile image"></div>

            @endif


            <form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                {{-- AVOID 419 ERROR  WITH CSRF WHEN SUBMITTING THE FORM--}}
                @csrf
                @method('PUT')

                {{-- NAME --}}
                <x-inputs.text id="name" name="name" label="Name" value="{{$user->name}}" />

                {{-- EMAIL --}}
                <x-inputs.text id="email" name="email" label="Email Address" value="{{$user->email}}" />


                {{-- -- AVATAR FILE INPUT -- --}}
                <x-inputs.file id="avatar" name="avatar" label="Upload profile image" />

                <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 border rounded hover:bg-green-600 focus:outline-none">Save</button>
            </form>
        </div>


        {{-- JOB LISTINGS --}}
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold mb-4">
                My Job Listings
            </h3>

            @forelse($jobs as $job)
            <div class="flex justify-between items-center border-b-2 border-gray-200 py-4">
                <div>
                    <h3 class="text-xl font-semibold">{{$job->title}}</h3>
                    <p class="text-gray-700">{{$job->job_type}}</p>
                </div>
                <div class="flex space-x-3">
                    {{-- EDIT BUTTON --}}
                    <a href="{{route('jobs.edit', $job->id)}}" class="bg-blue-500 text-white px-4 py-2 rounded text-sm">Edit</a>

                    {{--DELETE FORM--}}
                    <form method="POST" action="{{route('jobs.destroy', $job->id)}}?from=dashboard" onsubmit="return confirm('Are you sure you want to delete this job?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded text-sm">Delete</button>
                    </form>
                </div>
            </div>

            {{-- APPLICANTS --}}
            <div class="my-2 bg-gray-200">
                <h4 class="text-lg font-semibold mb-2">Applicants</h4>
                @forelse($job->applicants as $applicant)
                <div class="py-2">
                    <p class="text-gray-800">
                        <strong>Name:</strong> {{$applicant->full_name}}
                    </p>

                    <p class="text-gray-800">
                        <strong>Phone:</strong> {{$applicant->contact_phone}}
                    </p>

                    <p class="text-gray-800">
                        <strong>Email:</strong> {{$applicant->contact_email}}
                    </p>

                    <p class="text-gray-800">
                        <strong>Message:</strong> {{$applicant->message}}
                    </p>

                    <p class="text-gray-800 my-2">
                        <a href="{{asset('storage/' . $applicant->resume_path)}}" download class="text-blue-500 hover:underline text-sm"><i class="fas fa-download"></i>Download Resume</a>
                    </p>

                    {{-- DELETE APPLICANT BUTTON --}}
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this applicant?')" action={{route('applicant.destroy', $applicant->id)}}>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm"><i class="fas fa-trash"></i>Delete applicant</button>
                    </form>
                    <hr>


                </div>
                @empty
                <p class="text-gray-700">No applicants for this job.</p>
                @endforelse
            </div>

            @empty
            <p class="text-gray-700">You have no job listing yet.</p>
            @endforelse
        </div>
    </section>
    <x-bottom-banner />
</x-layout>
