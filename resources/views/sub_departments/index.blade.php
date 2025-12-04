@extends('Smile')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h5 class="mb-0">Daftar Sub Department</h5>
            <a href="{{ route('sub-departments.create') }}" class="btn btn-light btn-sm">+ Tambah</a>
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
                        <td>
                            <a href="{{ route('sub-departments.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('sub-departments.destroy', $d->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
