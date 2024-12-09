<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Job;


class JobController extends Controller
{

    use AuthorizesRequests;

    // @desc show all job listings
    // @route GET /jobs
    public function index(): View
    {
        $jobs = Job::latest()->paginate(9);
        return view('jobs.index')->with('jobs', $jobs);
    }


    // @desc show create form view
    // @route GET /jobs/create
    public function create(Request $request)
    {
        return view('jobs.create');
    }


    // @desc save job to database
    // @route POST /jobs
    public function store(Request $request): RedirectResponse
    {
        //job form validation
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url'
        ]);

        //assign user_id of job to the user id that is creating it.
        $validatedData['user_id'] = auth()->user()->id;

        //check for image
        if ($request->hasFile('company_logo')) {
            //Store the file and get path

            $path = $request->file('company_logo')->store('logos', 'public');

            //add path to validated data
            $validatedData['company_logo'] = $path;
        }


        //Submit to database
        Job::create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing created!');
    }


    // @desc display a single job listing
    // @route GET /jobs/{id}
    public function show(Job $job): View
    {
        return view('jobs.show')->with('job', $job);
    }


    // @desc edit page form for a single job listing
    // @route GET /jobs/{id}/edit
    public function edit(Job $job): View
    {

        //check if user is authorized to see edit page
        $this->authorize('update', $job);

        return view('jobs.edit')->with('job', $job);
    }


    // @desc update a job listing
    // @route PUT /jobs/{id}
    public function update(Request $request, Job $job)
    {

        //check if user is authorized
        $this->authorize('update', $job);

        //job form validation
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url'
        ]);

        //check for image
        if ($request->hasFile('company_logo')) {

            //delete previous logo if there was any
            Storage::disk('public')->delete($job->company_logo);

            //Store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            //add path to validated data
            $validatedData['company_logo'] = $path;
        }


        //Submit to database
        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing updated!');
    }


    // @desc delete job listing
    // @route DELETE /job/{id}
    public function destroy(Job $job): RedirectResponse
    {

        // check if user is authorized
        $this->authorize('delete', $job);


        //If job has logo, then delete
        if ($job->company_logo) {
            Storage::disk('public')->delete($job->company_logo);
        }

        //delete the job
        $job->delete();

        //check if request came from the dahsboard 
        if (request()->query('from') == 'dashboard') {
            return redirect()->route('dashboard')->with('success', 'Job listing deleted!');
        }

        return redirect()->route('jobs.index')->with('success', 'Job listing deleted!');
    }


    //@desc search job listing by query
    //@route GET /jobs/search
    public function search(Request $request): View
    {
        //get keywords and location from form input and transform them to lowcase
        $keywords = strtolower($request->input('keywords'));
        $location = strtolower($request->input('location'));

        $query = Job::query();

        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->whereRaw('LOWER(title) like ?', ['%' . $keywords . '%'])
                    ->orWhereRaw('LOWER(tags) like ?', ['%' . $keywords . '%'])
                    ->orWhereRaw('LOWER(description) like ?', ['%' . $keywords . '%']);
            });
        }

        if ($location) {
            $query->where(function ($q) use ($location) {
                $q->whereRaw('LOWER(address) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(city) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(state) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(zipcode) like ?', ['%' . $location . '%']);
            });
        }


        $jobs = $query->paginate(12);

        //return the index view with the jobs found
        return view('jobs.index')->with('jobs', $jobs);
    }
}
