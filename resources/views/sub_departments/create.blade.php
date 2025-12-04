@extends('Smile')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header text-white" style="background-color: #5ebeed;">
                    <h5 class="mb-0">Tambah Sub Department</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('sub-departments.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department_id" class="form-select" required>
                                <option value="">-- Pilih Department --</option>

                                @foreach ($departments as $d)
                                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Sub Department</label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-control" 
                                placeholder="Contoh: Web Development" 
                                required
                            >
                        </div>

                        <button 
                            type="submit" 
                            class="btn w-100 text-white"
                            style="background-color: #5ebeed;"
                        >
                            Simpan
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
