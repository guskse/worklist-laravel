<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    //@desc get all user bookmarks and return view
    //@route  GET /bookmarks
    public function index(): View
    {
        //Get the currently logged in user
        $user = Auth::user();

        //Get the user bookmarks and paginate it
        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);

        //return the view, passing bookmarks as props to be used in the view
        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }

    //@bookmark a job
    //@route  POST /bookmarks/{job}
    public function store(Job $job): RedirectResponse
    {
        //get user
        $user = Auth::user();

        //Check if job is already bookmarked
        if ($user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('status', 'Job is already bookmarked');
        }

        //Create a new bookmark
        $user->bookmarkedJobs()->attach($job->id);

        return back()->with('success', 'Job bookmarked successfully!');
    }


    //@remove bookmark job
    //@route  DELETE /bookmarks/{job}
    public function destroy(Job $job): RedirectResponse
    {
        //get user
        $user = Auth::user();

        //Check if job is not bookmarked
        if (!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'Job is not bookmarked');
        }

        //remove bookmark
        $user->bookmarkedJobs()->detach($job->id);

        return back()->with('success', 'Bookmark removed!');
    }
}
