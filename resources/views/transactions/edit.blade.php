@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Transaksi</h3>

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $transaction->date) }}" required>
        </div>

        <div class="mb-3">
            <label for="chart_of_account_id" class="form-label">Pilih COA</label>
            <select name="chart_of_account_id" id="chart_of_account_id" class="form-select" required>
                @foreach ($coa as $item)
                    <option value="{{ $item->id }}" {{ $transaction->chart_of_account_id == $item->id ? 'selected' : '' }}>
                        {{ $item->code }} - {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ $transaction->description}}" required>
        </div>

        <div class="mb-3">
            <label for="debit" class="form-label">Debit</label>
            <input type="text" name="debit" id="debit" class="form-control only-number" value="{{$transaction->debit}}" required>
        </div>

        <div class="mb-3">
            <label for="credit" class="form-label">Kredit</label>
            <input type="text" name="credit" id="credit" class="form-control only-number" value="{{$transaction->credit}}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Batal</a>
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
