<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->whereNotNull('deadline')
            ->get();

        $events = $tasks->map(function ($task) {
            $color = match ($task->type) {
                'interview' => '#3b82f6',
                'followup' => '#f59e0b',
                'assessment' => '#8b5cf6',
                default => '#10b981',
            };

            return [
                'title' => $task->title,
                'start' => $task->deadline,
                'backgroundColor' => $color,
                'borderColor' => $color,
                'extendedProps' => [
                    'type' => $task->type,
                    'description' => $task->description,
                    'location' => $task->location,
                    'link' => $task->link,
                ]
            ];
        });

        return view('calendar.index', compact('events'));
    }
}