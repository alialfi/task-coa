@extends('layouts.app')

@section('content')
    <h3>Tambah Chart of Account</h3>

    <form action="{{ route('coa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" class="form-select" required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="code" class="form-label">Kode</label>
            <input type="text" name="code" class="form-control" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            @error('code')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('coa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
