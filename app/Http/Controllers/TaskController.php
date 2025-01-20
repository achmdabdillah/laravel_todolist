<?php

// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Menampilkan daftar tugas
    public function index()
    {
        $tasks = Task::all(); // Mengambil semua tugas dari database
        return view('tasks.index', compact('tasks')); // Menampilkan tampilan index
    }

    // Menampilkan form untuk membuat tugas baru
    public function create()
    {
        // Ambil semua proyek yang tersedia untuk ditampilkan di form
        $projects = Project::all();

        return view('tasks.create', compact('projects'));
    }

    // Menyimpan tugas baru ke database
    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:not_started,in_progress,completed',
        ]);

        // Simpan tugas baru
        Task::create([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->route('projects.show', ['project' => $request->project_id])->with('success', 'Tugas berhasil dibuat!');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $task->update(['status' => $request->status]);
        return redirect()->route('projects.show', $task->project);
    }
}
