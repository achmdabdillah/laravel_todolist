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
        <!-- <div class="col-md-4">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" name="start_date" id="start_date" class="form-control"
                value="{{ request('start_date') }}">
        </div> -->
        <div class="col-md-4">
            <label for="deadline">Deadline</label>
            <input type="date" name="deadline" id="deadline" class="form-control" value="{{ request('deadline') }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Cari</button>
</form>
@foreach($projects as $project)
    <div>
        <h3>{{ $project->name }}</h3>
        <p>Deadline: {{ $project->deadline }}</p>
        <p>Completion: {{ $project->completion_percentage }}%</p>
        <a href="{{ route('projects.show', $project) }}">View Project</a>
    </div>
@endforeach
@endsection