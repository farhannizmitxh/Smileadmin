@extends('Smile')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm">
        <div class="card-header text-white d-flex justify-content-between align-items-center"
            style="background-color: #4e73df;">
            <h5 class="mb-0 text-white">Daftar Department</h5>
            <a href="{{ route('departments.create') }}" 
               class="btn btn-sm"
               style="background-color: #1cc88a; color: white;">
               + Tambah
            </a>
        </div>

        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{ $d->name }}</td>
                        <td class="d-flex text-center">

                            <a href="{{ route('departments.edit', $d->id) }}" 
                               class="btn btn-sm"
                               style="background-color: #f6c23e; color: white;">
                               Edit
                            </a>

                            &nbsp;

                            <form action="{{ route('departments.destroy', $d->id) }}" 
                                  method="POST" class="mb-0">
                                @csrf
                                @method('delete')
                                <button type="submit" 
                                    class="btn btn-sm"
                                    style="background-color: #e74a3b; color: white;"
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
@endsection
