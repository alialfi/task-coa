@extends('layouts.app')

@section('content')
    <h3>Edit Chart of Account</h3>

    <form action="{{ route('coa.update', $coa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="code" class="form-label">Kode</label>
            <input type="text" class="form-control" name="code" id="code" value="{{ old('code', $coa->code) }}" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $coa->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-select" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $coa->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('coa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
