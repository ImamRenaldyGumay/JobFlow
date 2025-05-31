<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')->get();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'date_applied' => 'nullable|date',
            'applied_via' => 'nullable|string|max:255',
            'apply_link' => 'nullable|url|max:255',
            'application_status' => 'nullable|string|max:255',
            'result' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        Job::create($validated);
        return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'date_applied' => 'nullable|date',
            'applied_via' => 'nullable|string|max:255',
            'apply_link' => 'nullable|url|max:255',
            'application_status' => 'nullable|string|max:255',
            'result' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        $job->update($validated);
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}
