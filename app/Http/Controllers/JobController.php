<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Employer;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->with(['employer', 'tags'])->get()->groupBy('featured');
        return view('jobs.index', [
            'jobs' => $jobs[0],
            'featuredJobs' => $jobs[1],
            'tags' => Tag::all(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            Session::flash('alert', 'You Have to Login to post a new job');            // Redirect to the login page if not authenticated
            return redirect('/login'); // Make sure 'login' is the name of your login route
        }
        //creating a new job page
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable'],
        ]);
        //store a new job
        $attributes['featured'] = $request->has('featured');
        // when we access the authenticated user, we get the user objects and not fake data

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));
        //check if we have tags or not

        if ($attributes['tags'] ?? false) {
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag);
            }
        }
        //redirect to the home page

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function userJobs()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Assuming the user is an employer, retrieve jobs posted by the authenticated user's employer
        $jobs = Job::where('employer_id', $user->employer->id)->latest()->with(['employer', 'tags'])->get();

        return view('auth.dashboard', [
            'jobs' => $jobs,
            'tags' => Tag::all(),
        ]);
    }
    public function destroyJob($id)
    {
        // Find the job by ID
        $job = Job::findOrFail($id);

        // Delete the job
        $job->delete();

        // Redirect back with a success message
        return redirect('/dashboard');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function editJob($id)
    {
        // Find the job by ID
        $job = Job::findOrFail($id);
        // Return the edit view with the job data
        return view('auth.editJob', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateJob(Request $request, $id)
    {
        // Find the job by ID
        $job = Job::findOrFail($id);

        // Validate the incoming request data
        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable'], // This is for handling tags
        ]);

        // Handle tags if provided
        if ($attributes['tags'] ?? false) {
            $job->tags()->detach(); // Remove existing tags
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag(trim($tag)); // Add new tags, trimming whitespace
            }
        }

        // Remove 'tags' from attributes before updating
        unset($attributes['tags']);

        // Update the job with the validated data
        $job->update($attributes);

        // Redirect back with a success message
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
