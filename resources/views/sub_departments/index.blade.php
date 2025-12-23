@extends('Smile')

@section('content')


    <div class="card shadow-sm">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background:#5ebeed;">
            <h5 class="mb-0 text-white">Daftar Sub Department</h5>

            <button class="btn btn-light btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#modalAdd">
                + Tambah
            </button>
        </div>

        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nama Sub</th>
                        <th>Department</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->department->name }}</td>
                        <td class="d-flex gap-2">

                            <button class="btn btn-sm text-white btn-edit"
                                style="background-color:#f6c23e;"
                                data-id="{{ $d->id }}"
                                data-name="{{ $d->name }}"
                                data-department="{{ $d->department_id }}">
                                Edit
                            </button>

                            <form action="{{ route('sub-departments.destroy', $d->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm text-white"
                                    style="background-color:#e74a3b;"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- ================= MODAL TAMBAH ================= --}}
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog">
        <form id="formAdd" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Tambah Sub Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Sub Department</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Department</label>
                    <select name="department_id" class="form-select" required>
                        <option value="">-- Pilih Department --</option>
                        @foreach($departments as $dep)
                            <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- ================= MODAL EDIT ================= --}}
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <form id="formEdit" class="modal-content">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_id">

            <div class="modal-header">
                <h5 class="modal-title">Edit Sub Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Sub Department</label>
                    <input type="text" id="edit_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Department</label>
                    <select id="edit_department" class="form-select" required>
                        @foreach($departments as $dep)
                            <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                        @endforeach
                    </select>
                </div>
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

    // ADD
    $('#formAdd').submit(function (e) {
        e.preventDefault();

        $.post("{{ route('sub-departments.store') }}", $(this).serialize(), function () {
            location.reload();
        });
    });

    // OPEN EDIT
    $('.btn-edit').click(function () {
        $('#edit_id').val($(this).data('id'));
        $('#edit_name').val($(this).data('name'));
        $('#edit_department').val($(this).data('department'));

        $('#modalEdit').modal('show');
    });

    // UPDATE
    $('#formEdit').submit(function (e) {
        e.preventDefault();

        const id = $('#edit_id').val();

        $.ajax({
            url: `/sub-departments/${id}`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                name: $('#edit_name').val(),
                department_id: $('#edit_department').val()
            },
            success: function () {
                location.reload();
            }
        });
    });

});
</script>
@endpush
