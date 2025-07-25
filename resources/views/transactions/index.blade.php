@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Transaksi</h3>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">+ Tambah Transaksi</a>
    </div>
    <table id="transaction_table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>COA Kode</th>
                <th>COA Nama</th>
                <th>Deskripsi</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

<script>
$(document).ready(function() {
    $('#transaction_table').DataTable({
        ajax: "{{ route('transactions.data') }}",
        columns: [
            { data: 'date', name: 'date' },
            {
                data: 'chart_of_account.code',
                defaultContent: '-'
            },
            {
                data: 'chart_of_account.name',
                defaultContent: '-'
            },
            { data: 'description', name: 'description' },
            { data: 'debit', name: 'debit', className: 'text-end' },
            { data: 'credit', name: 'credit', className: 'text-end' },
            {
                data: 'id',
                name: 'id',
                render: function(data, type, row) {
                    return `
                        <a href="/transactions/${data}/edit" class="btn btn-success btn-sm me-1">Edit</a>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${data}">Hapus</button>
                    `;
                },
                orderable: false,
                searchable: false
            }
        ]
    });

    $('#transaction_table').on('click', '.delete-btn', function() {
        const id = $(this).data('id');
        if (confirm('Yakin ingin menghapus transaksi ini?')) {
            $.ajax({
                url: `/transactions/${id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#transaction_table').DataTable().ajax.reload();
                    alert(response.message);
                },
                error: function(xhr) {
                    alert('Gagal menghapus transaksi.');
                }
            });
        }
    });
});
</script>
