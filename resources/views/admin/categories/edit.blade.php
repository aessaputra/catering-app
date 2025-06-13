@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Edit Kategori</h3>
    </div>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan Nama Kategori" value="{{ old('name', $category->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="Masukkan Slug" value="{{ old('slug', $category->slug) }}">
                <small class="form-text text-muted">Biarkan kosong untuk generate otomatis dari nama.</small>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection