<x-layout>
    <x-slot name="title">Workopia | Edit Job</x-slot>

    <div class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl">

        <h2 class="text-4xl text-center font-bold mb-4">
            Edit Job Listing
        </h2>

        {{-- FORM --}}
        <form method="POST" action="{{route('jobs.update', $job->id)}}" enctype="multipart/form-data">

            {{-- AVOID 419 ERROR  WITH CSRF WHEN SUBMITTING THE FORM--}}
            @csrf

            {{-- PUT REQUEST TO EDIT DATA--}}
            @method('PUT')


            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Job Info
            </h2>

            {{-- TITLE INPUT --}}
            <x-inputs.text id="title" name="title" label="Job Title" placeholder="Software Engineer" :value="old('title',$job->title)" />


            {{-- JOB DESCRIPTION INPUT AREA--}}
            <x-inputs.text-area id="description" name="description" label="Job Description" placeholder="We are seeking a experienced developer to fill the role" :value="old('description',$job->description)" />


            {{-- SALARY INPUT --}}
            <x-inputs.text id="salary" type="number" name="salary" label="Salary" placeholder="$40000" :value="old('salary', $job->salary)" />


            {{-- REQUIREMENTS INPUT AREA --}}
            <x-inputs.text-area id="requirements" name="requirements" label="Job Requirements" placeholder="Bachelor's degree in compute science" :value="old('requirements', $job->requirements)" />


            {{-- BENEFITS INPUT AREA --}}
            <x-inputs.text-area id="benefits" name="benefits" label="Job Benefits" placeholder="Health insurance, 401k, paid time off" :value="old('benefits',$job->benefits)" />


            {{-- TAGS INPUT --}}
            <x-inputs.text id="tags" name="tags" label="Tags (comma-separated)" placeholder="development,coding,java,python" :value="old('tags',$job->tags)" />


            {{-- JOB TYPE SELECT INPUT --}}
            <x-inputs.select id="job_type" name="job_type" label="Job Type" :options="['Full-Time' => 'Full-Time', 'Part-Time' => 'Part-Time', 'Contract' => 'Contract', 'Temporary' => 'Temporary', 'Internship' => 'Internship', 'Volunteer' => 'Volunteer', 'On-Call' => 'On-Call']" :value="old('job_type',$job->job_type)" />


            {{--REMOTE SELECT INPUT --}}
            <x-inputs.select id="remote" name="remote" label="Remote" :options="[0 => 'No', 1 => 'Yes']" :value="old('remote',$job->remote)" />


            {{-- ADDRESS INPUT --}}
            <x-inputs.text id="address" name="address" label="Address" placeholder="123 Main St" :value="old('address',$job->address)" />


            {{-- CITY INPUT --}}
            <x-inputs.text id="city" name="city" label="City" placeholder="Albany" :value="old('city', $job->city)" />


            {{-- ESTATE INPUT --}}
            <x-inputs.text id="state" name="state" label="State" placeholder="NY" :value="old('state',$job->state)" />


            {{-- ZIPCODE INPUT --}}
            <x-inputs.text id="zipcode" name="zipcode" label="ZIP Code" placeholder="12201" :value="old('zipcode',$job->zipcode)" />


            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Company Info
            </h2>


            {{-- COMPANY INFO INPUT --}}
            <x-inputs.text id="company_name" name="company_name" label="Company Name" placeholder="Company name" :value="old('company_name',$job->company_name)" />


            {{-- COMPANY DESCRIPTION INPUT --}}
            <x-inputs.text-area id="company_description" name="company_description" label="Company Description" placeholder="Enter company description" :value="old('company_description',$job->company_description)" />


            {{-- COMPANY WEBSITE INPUT --}}
            <x-inputs.text id="company_website" type="url" name="company_website" label="Company Website" placeholder="Enter website" :value="old('company_website',$job->company_website)" />


            {{-- CONTACT PHONE INPUT --}}
            <x-inputs.text id="contact_phone" name="contact_phone" label="Contact Phone" placeholder="Enter phone" :value="old('contact_phone',$job->contact_phone)" />


            {{-- CONTACT EMAIL INPUT --}}
            <x-inputs.text id="contact_email" type="email" name="contact_email" label="Contact Email" placeholder="Enter where you want to receive applications" :value="old('contact_email',$job->contact_email)" />


            {{-- FILE INPUT --}}
            <x-inputs.file id="company_logo" name="company_logo" label="Company Logo" :value="old('company_logo',$job->company_logo)" />


            {{-- BUTTON SUBMIT --}}
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
                Save
            </button>

        </form>
    </div>

</x-layout>
