<!-- resources/views/projects/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Daftar Proyek</h1>
<!-- Form Pencarian -->
<form action="{{ route('projects.index') }}" method="GET">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="name">Cari berdasarkan Nama Proyek</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
        </div>
        <div class="col-md-4">
            <label for="deadline">Deadline</label>
            <input type="date" name="deadline" id="deadline" class="form-control" value="{{ request('deadline') }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Cari</button>
</form>
<div class="row justify-content-start mt-2">
    @foreach($projects as $project)
        <div class="border rounded col-md-4 mx-2 p-3">
            <h3>{{ $project->name }}</h3>
            <p>Deadline: {{ $project->deadline }}</p>
            <p>Completion: {{ $project->completion_percentage }}%</p>
            <a href="{{ route('projects.show', $project) }}">View Project</a>
        </div>
    @endforeach
</div>

<!-- Show SweetAlert if there are projects due in 2 days -->
@if($projectsDueSoon->isNotEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Loop through each project and show an alert for each one
            @foreach($projectsDueSoon as $project)
                Swal.fire({
                    title: 'Deadline Mendekat!',
                    text: 'Proyek "{{ $project->name }}" akan jatuh tempo dalam 2 hari.',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                });
            @endforeach
        });
    </script>
@endif

@endsection