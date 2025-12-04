@extends('Smile')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header text-white" style="background-color: #5ebeed;">
                    <h5 class="mb-0">Tambah Department</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('departments.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Department</label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: PPLG" required>
                        </div>

                        <button type="submit" class="btn w-100 text-white" style="background-color: #5ebeed;">
                            Simpan
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
