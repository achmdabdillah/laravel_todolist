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

        // Check for projects whose deadline is 2 days from now
        $projectsDueSoon = Project::whereDate('deadline', Carbon::now()->addDays(2)->toDateString())->get();

        // Kembalikan tampilan dengan proyek yang sudah difilter dan proyek yang deadline-nya 2 hari lagi
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

        return view('projects.show', compact('project', 'sortedTasks'));
    }
}
