<!-- resources/views/projects/show.blade.php -->
@extends('layouts.app')

@section("content")
<div style="width: 200px;">
    <canvas id="projectProgressChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('projectProgressChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Remaining'],
            datasets: [{
                label: 'Project Progress',
                data: [{{ $project->completion_percentage }}, 100 - {{ $project->completion_percentage }}],
                backgroundColor: ['#28a745', '#dc3545'],
                borderWidth: 1,
            }]
        },
        options: {
            // responsive: true,
            maintainAspectRatio: false // Allows for resizing based on CSS
        }
    });
</script>
<h1>{{ $project->name }}</h1>
<p>{{ $project->description }}</p>

<h2>Tasks</h2>
<!-- <a href="{{ route('tasks.create') }}" class="btn btn-primary">Tambah Tugas Baru</a> -->
<a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="btn btn-primary">Tambah Tugas Baru</a>

@foreach($project->tasks as $task)
    <div>
        <h3>{{ $task->title }}</h3>
        <p>Status: {{ ucfirst($task->status) }}</p>
        <form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
            @csrf
            @method('PATCH')
            <select name="status">
                <option value="not_started" {{ $task->status == 'not_started' ? 'selected' : '' }}>Not Started</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            <button type="submit">Update Status</button>
        </form>
    </div>
@endforeach
@endsection