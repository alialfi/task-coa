@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Transaksi</h3>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="chart_of_account_id" class="form-label">Pilih COA</label>
            <select name="chart_of_account_id" id="chart_of_account_id" class="form-select" required>
                <option value="">-- Pilih COA --</option>
                @foreach ($coa as $item)
                    <option value="{{ $item->id }}">{{ $item->code }} - {{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <input type="text" name="description" id="description" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="debit" class="form-label">Debit</label>
            <input type="text" name="debit" id="debit" class="form-control only-number" placeholder="Masukkan angka" required>
        </div>

        <div class="mb-3">
            <label for="credit" class="form-label">Kredit</label>
            <input type="text" name="credit" id="credit" class="form-control only-number" placeholder="Masukkan angka" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

<script>
    document.querySelectorAll('.only-number').forEach(function (input) {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
</script>
