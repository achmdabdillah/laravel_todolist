@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Tugas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel untuk menampilkan tugas -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul Tugas</th>
                <th>Proyek</th>
                <th>Tenggat Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->project->name }}</td> <!-- Menampilkan nama proyek terkait -->
                    <td>{{ $task->due_date->format('d-m-Y') }}</td>
                    <td>
                        <span class="badge 
                                    @if($task->status == 'not_started') badge-secondary
                                    @elseif($task->status == 'in_progress') badge-primary
                                    @elseif($task->status == 'completed') badge-success
                                    @endif">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </td>
                    <td>
                        <!-- Tombol untuk mengedit atau menghapus tugas, jika ada -->
                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada tugas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Tambah Tugas Baru</a>
</div>
@endsection