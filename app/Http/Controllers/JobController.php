<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Job;




class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jobs = Job::all();
        return view('jobs.index')->with('jobs', $jobs);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        return view('jobs.create');
    }


    /**
     * Store a newly created resource in storage.
     */
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

        //hardcoded user id
        $validatedData['user_id'] = 1;

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


    /**
     * Display the specified resource.
     */
    public function show(Job $job): View
    {
        return view('jobs.show')->with('job', $job);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job): View
    {
        return view('jobs.edit')->with('job', $job);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job): RedirectResponse
    {
        //If job has logo, then delete
        if ($job->company_logo) {
            Storage::disk('public')->delete($job->company_logo);
        }

        //delete the job
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job listing deleted!');
    }
}
