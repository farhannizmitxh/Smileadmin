@extends('Smile')

@section('content')
<div class="container-xxl container-p-y">

<div class="row justify-content-center">

<div class="col-lg-12 mb-4">
<div class="card shadow border-0">
    <div class="card-header text-white" style="background:#5ebeed;">
        <h4 class="mb-0">Form News</h4>
    </div>

    <div class="card-body">
        <form action="/news" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Judul</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Excerpt</label>
                <input type="number" name="excerpt" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal</label>
                <input type="text" name="date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Penulis</label>
                <input type="text" name="writer" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Thumbnail URL</label>
                <input type="text" name="thumbnail" class="form-control">
            </div>

            <button class="btn text-white w-100" style="background:#5ebeed;">
                Simpan News
            </button>
        </form>
    </div>
</div>
</div>
<div class="col-lg-12">
    <div class="card shadow border-0">
        <div class="card-header bg-white">
            <h5 class="mb-0 fw-semibold">Daftar News</h5>
        </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Penulis</th>
                    <th>Aksi</th>
                </tr>
                </thead>

    <tbody>
            @foreach ($news as $item)

            {{-- ROW SHOW --}}
            <tr class="show" data-id="{{ $item->id }}">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->title }}</td>
                <td class="text-center">{{ $item->excerpt }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->writer }}</td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn btn-warning btn-sm btn-edit">Edit</button>
                        <form action="/news/{{ $item->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus news ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>

            {{-- ROW EDIT --}}
            <tr class="edit d-none" data-id="{{ $item->id }}">
                <td class="text-center">{{ $loop->iteration }}</td>

                <td>
                    <input type="text" name="title" class="form-control form-control-sm"
                        value="{{ $item->title }}">
                </td>

                <td>
                    <input type="number" name="excerpt" class="form-control form-control-sm"
                        value="{{ $item->excerpt }}">
                </td>

                <td>
                    <input type="text" name="date" class="form-control form-control-sm"
                        value="{{ $item->date }}">
                </td>

                <td>
                    <input type="text" name="writer" class="form-control form-control-sm"
                        value="{{ $item->writer }}">
                </td>

                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn btn-success btn-sm btn-update">Update</button>
                        <button class="btn btn-secondary btn-sm btn-cancel">Cancel</button>
                    </div>
                </td>
            </tr>
@endforeach
    </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('script')
<script>
$(document).ready(function () {

    $(document).on('click', '.btn-edit', function () {
        const showRow = $(this).closest('tr.show');
        showRow.addClass('d-none');
        showRow.next('.edit').removeClass('d-none');
    });

    $(document).on('click', '.btn-cancel', function () {
        const editRow = $(this).closest('tr.edit');
        editRow.addClass('d-none');
        editRow.prev('.show').removeClass('d-none');
    });

    $(document).on('click', '.btn-update', function (e) {
        e.preventDefault();

        const row = $(this).closest('tr.edit');
        const id = row.data('id');

        $.ajax({
            url: `/news/${id}`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                title: row.find('[name="title"]').val(),
                excerpt: row.find('[name="excerpt"]').val(),
                date: row.find('[name="date"]').val(),
                writer: row.find('[name="writer"]').val(),
            },
            success: function () {
                location.reload();
            },
            error: function () {
                alert('Update news gagal');
            }
        });
    });

});
</script>
@endpush
