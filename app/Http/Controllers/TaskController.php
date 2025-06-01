<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->orderBy('deadline')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,done',
            'type' => 'required|string',
            'location' => 'nullable|string',
            'link' => 'nullable|string',
        ]);
        $validated['user_id'] = auth()->id();
        if ($request->filled('deadline')) {
            $deadline = \DateTime::createFromFormat('m/d/Y', $request->deadline);
            if ($deadline) {
                $validated['deadline'] = $deadline->format('Y-m-d');
            }
        }
        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,done',
            'type' => 'required|string',
            'location' => 'nullable|string',
            'link' => 'nullable|string',
        ]);
        $validated['user_id'] = auth()->id();
        if ($request->filled('deadline')) {
            $deadline = \DateTime::createFromFormat('m/d/Y', $request->deadline);
            if ($deadline) {
                $validated['deadline'] = $deadline->format('Y-m-d');
            }
        }
        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function show(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
        return view('tasks.edit', compact('task'));
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }
}