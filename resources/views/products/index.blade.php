@extends('Smile')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row justify-content-center">

        <!-- Form tambah produk -->
        <div class="col-lg-8 col-md-10 mb-4">
            <div class="card shadow-lg border-0">
                <div class="card-header text-white" style="background:#5ebeed;">
                    <h4 class="mb-0">Form Produk</h4>
                </div>

                <div class="card-body p-4">

                    <form action="/products" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Produk</label>
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Contoh: Kopi Latte" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Harga</label>
                                <input type="number" name="price" class="form-control form-control-lg" placeholder="Contoh: 15000" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Stok</label>
                                <input type="number" name="stock" class="form-control form-control-lg" placeholder="Contoh: 10" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">URL Gambar</label>
                            <input type="text" name="image" class="form-control form-control-lg" placeholder="https://contoh.com/gambar.jpg">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori Utama</label>
                            <select name="main_category" class="form-select form-select-lg" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="tefa">TEFA</option>
                                <option value="mandiri">Mandiri</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Department</label>
                            <select id="department" name="department" class="form-select form-select-lg" required>
                                <option value="">-- Pilih Department --</option>
                                @foreach($departments as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Sub Department</label>
                            <select id="product_category" name="product_category" class="form-select form-select-lg" required>
                                <option value="">-- Pilih Sub Department --</option>
                            </select>
                        </div>

                        <button type="submit" class="btn text-white w-100 py-2" style="background:#5ebeed;">
                            Simpan Produk
                        </button>

                    </form>
                </div>
            </div>
        </div>
        <!-- END FORM -->

        <!-- TABLE LIST PRODUK -->
        <div class="col-lg-10 col-md-12">
            <div class="card shadow-sm border-0">
                <div class="table-responsive p-3">

                    <table class="table table-hover align-middle bg-white">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Kategori Utama</th>
                                <th>Department</th>
                                <th>Sub Dept</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $prod)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prod->name }}</td>
                                    <td>Rp {{ number_format($prod->price, 0, ',', '.') }}</td>
                                    <td>{{ $prod->stock }}</td>
                                    <td>{{ $prod->main_category }}</td>
                                    <td>{{ $prod->department }}</td>
                                    <td>{{ $prod->product_category }}</td>
                                    <td class="d-flex">
                                        <a href="/products/{{ $prod->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                        &nbsp;
                                        <form action="/products/{{ $prod->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
        <!-- END TABLE -->

    </div>
</div>
@endsection
