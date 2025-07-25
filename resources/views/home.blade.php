@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Laporan Profit / Loss Bulanan per Kategori</h3>
    <form method="GET" class="mb-3">
        <label for="year">Pilih Tahun:</label>
        <input type="number" name="year" id="year" value="{{ $result['selectedYear'] }}" class="form-control d-inline-block w-auto">
        <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
        <a href="{{ route('home.downloadExcel', ['year' => $result['selectedYear']]) }}" class="btn btn-success">Download Excel</a>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Category</th>
                    @foreach($result['months'] as $month)
                        <th>{{ $month }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($result['categories'] as $cat)
                <tr class="{{ $cat['type'] === 'income' ? 'table-success' : 'table-danger' }}">
                    <td>{{ $cat['name'] }}</td>
                    @foreach($result['months'] as $month)
                        <td class="text-end">
                            {{ number_format($cat['months'][$month] ?? 0, 0, ',', '.') }}
                        </td>
                    @endforeach
                </tr>
                @endforeach
                <tr class="table-success fw-bold">
                    <td>Total Income</td>
                    @foreach($result['months'] as $month)
                        <td class="text-end">
                            {{ number_format($result['totals'][$month]['income'], 0, ',', '.') }}
                        </td>
                    @endforeach
                </tr>
                <tr class="table-danger fw-bold">
                    <td>Total Expense</td>
                    @foreach($result['months'] as $month)
                        <td class="text-end">
                            {{ number_format($result['totals'][$month]['expense'], 0, ',', '.') }}
                        </td>
                    @endforeach
                </tr>
                <tr class="table-primary fw-bold">
                    <td>Net Income</td>
                    @foreach($result['months'] as $month)
                        <td class="text-end">
                            {{ number_format($result['totals'][$month]['net'], 0, ',', '.') }}
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
