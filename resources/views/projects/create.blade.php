@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Proyek Baru</h1>

    <!-- Formulir untuk membuat proyek baru -->
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama Proyek</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name') }}" required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Proyek</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" rows="4">{{ old('description') }}</textarea>

            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deadline">Tenggat Waktu</label>
            <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline"
                name="deadline" value="{{ old('deadline') }}" required>

            @error('deadline')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Proyek</button>
    </form>
</div>
@endsection