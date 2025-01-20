<?php

// app/Http/Controllers/ProjectController.php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // public function index(Request $request)
    // {
    //     $query = Project::query();

    //     if ($request->has('search')) {
    //         $query->where('name', 'like', '%' . $request->search . '%')
    //             ->orWhereDate('deadline', '=', $request->search);
    //     }

    //     $projects = $query->with('tasks')->get();
    //     return view('projects.index', compact('projects'));
    // }

    public function index(Request $request)
    {
        // Ambil data proyek berdasarkan parameter pencarian
        $query = Project::query();

        // Filter berdasarkan nama proyek
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // // Filter berdasarkan tanggal mulai (jika ada)
        // if ($request->filled('start_date')) {
        //     $query->whereDate('created_at', '>=', $request->start_date);
        // }

        // Filter berdasarkan tanggal selesai (jika ada)
        if ($request->filled('deadline')) {
            $query->whereDate('deadline', '<=', $request->deadline);
        }

        // Ambil proyek yang sudah difilter
        $projects = $query->get();

        // Kembalikan tampilan dengan proyek yang sudah difilter
        return view('projects.index', compact('projects'));
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
        return view('projects.show', compact('project'));
    }
}

