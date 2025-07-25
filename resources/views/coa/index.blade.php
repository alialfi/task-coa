@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Chart Of Account</h3>
        <a href="{{ route('coa.create') }}" class="btn btn-primary">+ Tambah Chart Of Account</a>
    </div>
    <table id="coa_table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
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
    $('#coa_table').DataTable({
        ajax: "{{ route('coa.data') }}",
        columns: [
            { data: 'code' },
            { data: 'name', name: 'name' },
            {
                data: 'category.name',
                defaultContent: '-'
            },
            { 
                data: 'id', 
                name: 'id', 
                render: function(data, type, row) {
                    return `
                        <a href="/coa/${data}/edit" class="btn btn-success btn-sm me-1">Edit</a>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${data}">Hapus</button>
                    `;
                },
                orderable: false,
                searchable: false
            }
        ]
    });

    $('#coa_table').on('click', '.delete-btn', function() {
        const id = $(this).data('id');
        if (confirm('Yakin ingin menghapus data ini?')) {
            $.ajax({
                url: `/coa/${id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#coa_table').DataTable().ajax.reload();
                    alert(response.message);
                },
                error: function(xhr) {
                    alert('Gagal menghapus data.');
                }
            });
        }
    });
});
</script>
