@extends('Smile')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm">
        <div class="card-header text-white d-flex justify-content-between align-items-center"
            style="background-color: #4e73df;">
            <h5 class="mb-0">Daftar Department</h5>

            <!-- Button Tambah -->
            <button class="btn btn-sm"
                style="background-color: #1cc88a; color: white;"
                data-bs-toggle="modal"
                data-bs-target="#modalAdd">
                + Tambah
            </button>
        </div>

        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>     
                    <tr>
                        <th>Nama</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{ $d->name }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <!-- Edit -->
                                <button
                                    class="btn btn-sm btn-edit"
                                    data-id="{{ $d->id }}"
                                    data-name="{{ $d->name }}"
                                    style="background-color: #f6c23e; color: white;">
                                    Edit
                                </button>

                                <!-- Delete -->
                                <form action="{{ route('departments.destroy', $d->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="btn btn-sm"
                                        style="background-color: #e74a3b; color: white;"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

<!-- ================= MODAL ADD ================= -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog">
        <form id="formAdd" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Tambah Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label class="form-label">Nama Department</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <form id="formEdit" class="modal-content">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_id">

            <div class="modal-header">
                <h5 class="modal-title">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label class="form-label">Nama Department</label>
                <input type="text" id="edit_name" class="form-control" required>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning text-white">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('script')
<script>
$(document).ready(function () {

    // TAMBAH
    $('#formAdd').submit(function (e) {
        e.preventDefault();

        $.post("{{ route('departments.store') }}", $(this).serialize())
            .done(() => location.reload());
    });

    // BUKA MODAL EDIT
    $('.btn-edit').on('click', function () {
        $('#edit_id').val($(this).data('id'));
        $('#edit_name').val($(this).data('name'));
        $('#modalEdit').modal('show');
    });

    // UPDATE
    $('#formEdit').submit(function (e) {
        e.preventDefault();

        const id = $('#edit_id').val();

        $.ajax({
            url: `/departments/${id}`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                name: $('#edit_name').val()
            },
            success: function () {
                location.reload();
            },
            error: function () {
                alert('Gagal update department');
            }
        });
    });

});
</script>
@endpush
