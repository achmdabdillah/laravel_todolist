<?php

// app/Http/Controllers/ProjectController.php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data proyek berdasarkan parameter pencarian
        $query = Project::query();

        // Filter berdasarkan nama proyek
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter berdasarkan tanggal selesai (jika ada)
        if ($request->filled('deadline')) {
            $query->whereDate('deadline', '<=', $request->deadline);
        }

        // Ambil proyek yang sudah difilter
        $projects = $query->get();

        // // Loop through projects to include completion percentage for each one
        $projects->each(function ($project) {
            // Access completion percentage
            $project->completion_percentage = $project->completion_percentage;
        });

        // Get projects with deadline in the next 1 or 2 days
        $projectsDueSoon = Project::whereDate('deadline', Carbon::now()->addDay()->toDateString())
            ->orWhereDate('deadline', Carbon::now()->addDays(2)->toDateString())
            ->get();
        $projectsDueSoon = $projectsDueSoon->filter(function ($project) {
            return $project->completion_percentage < 100;
        });

        // return tampilan dengan proyek yang sudah difilter dan proyek yang deadline-nya 2 hari lagi
        return view('projects.index', compact('projects', 'projectsDueSoon'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'deadline' => 'required|date',
        ]);

        Project::create($request->all());
        return redirect()->route('projects.index');
    }

    public function show(Project $project)
    {
        // Define the order for statuses
        $statusOrder = ['not_started', 'in_progress', 'completed'];

        // Sort tasks based on the predefined status order
        $sortedTasks = $project->tasks->sortBy(function ($task) use ($statusOrder) {
            return array_search($task->status, $statusOrder);
        });

        // Get tasks that are due in 2 days for this project
        $tasksDueSoon = $project->tasks->filter(function ($task) {
            // Ensure the date is parsed as a Carbon instance and check if the task is due within the next 2 days
            if (($task->status) != 'completed') {
                $dueDate = Carbon::parse($task->due_date);
                return $dueDate->isToday() || $dueDate->isTomorrow() || $dueDate->isSameDay(Carbon::now()->addDays(2));
            }
        });


        return view('projects.show', compact('project', 'sortedTasks', 'tasksDueSoon'));
    }
}
