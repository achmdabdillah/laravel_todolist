@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Tugas Baru</h1>

    <!-- Form untuk menambahkan tugas -->
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <!-- Input untuk memilih proyek -->
        <div class="form-group">
            <label for="project_id">Pilih Proyek</label>
            <select name="project_id" id="project_id" class="form-control @error('project_id') is-invalid @enderror"
                required>
                <option value="" disabled selected>-- Pilih Proyek --</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ (old('project_id') == $project->id || request()->get('project_id') == $project->id) ? 'selected' : '' }}
                        data-deadline="{{ $project->deadline }}">
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>

            @error('project_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input untuk judul tugas -->
        <div class="form-group">
            <label for="title">Judul Tugas</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title') }}" required>

            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Textarea untuk deskripsi tugas -->
        <div class="form-group">
            <label for="description">Deskripsi Tugas</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" rows="4">{{ old('description') }}</textarea>

            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input untuk tanggal tenggat waktu -->
        <div class="form-group">
            <label for="due_date">Tenggat Waktu</label>
            <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date"
                name="due_date" value="{{ old('due_date') }}" min="{{ now()->toDateString() }}" required>

            @error('due_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pilihan status tugas -->
        <div class="form-group">
            <label for="status">Status Tugas</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="not_started" {{ old('status') == 'not_started' ? 'selected' : '' }}>Belum Dimulai</option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>Sedang Berlangsung
                </option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>

            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Tugas</button>
    </form>
</div>

<!-- JavaScript to set the max date for due_date based on selected project -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const projectSelect = document.getElementById('project_id');
        const dueDateInput = document.getElementById('due_date');

        // When project is selected, set the max date for due_date
        projectSelect.addEventListener('change', function () {
            const selectedOption = projectSelect.options[projectSelect.selectedIndex];
            const projectDeadline = selectedOption.getAttribute('data-deadline');
            dueDateInput.setAttribute('max', projectDeadline);
        });

        // Set the max date if a project is already selected when the page loads
        if (projectSelect.value) {
            const selectedOption = projectSelect.options[projectSelect.selectedIndex];
            const projectDeadline = selectedOption.getAttribute('data-deadline');
            dueDateInput.setAttribute('max', projectDeadline);
        }
    });
</script>
@endsection