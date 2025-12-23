@extends('Smile')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row justify-content-center">

        <!-- Form tambah produk -->
        <div class="col-lg-14 col-md-12 mb-8">
            <div class="card shadow-lg border-0">
            <div class="card-header text-white" style="background:#5ebeed;">
                </div>
                <h4 class="mb-0 text-white">Form Produk</h4>
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
                            <select name="department_id" id="department" class="form-select" required>
                                <option value="">-- Pilih Department --</option>
                                @foreach($departments as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Sub Department</label>
                            <select name="sub_department_id" id="sub_department" class="form-select" required>
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
        <div class="col-lg-14 col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-semibold">Daftar Produk</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th style="width:5%">#</th>
                                <th>Nama Produk</th>
                                <th style="width:12%">Harga</th>
                                <th style="width:8%">Stok</th>
                                <th style="width:12%">Kategori</th>
                                <th>Department</th>
                                <th>Sub Dept</th>
                                <th style="width:15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($products as $prod)

                        {{-- ROW TAMPIL --}}
                        <tr class="show" data-id="{{ $prod->id }}">
                            <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                            <td>{{ $prod->name }}</td>
                            <td class="text-end">Rp {{ number_format($prod->price, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $prod->stock }}</td>
                            <td class="text-center">{{ strtoupper($prod->main_category) }}</td>
                            <td>{{ $prod->department->name }}</td>
                            <td>{{ $prod->subDepartment->name ?? '-' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-warning btn-sm btn-edit">Edit</button>
                                    <form action="/products/{{ $prod->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- ROW EDIT --}}
                        <tr class="edit d-none" data-id="{{ $prod->id }}">
                            <td class="text-center fw-semibold">{{ $loop->iteration }}</td>

                            <td>
                                <input type="text" name="name"
                                    class="form-control form-control-sm"
                                    value="{{ $prod->name }}">
                            </td>

                            <td>
                                <input type="number" name="price"
                                    class="form-control form-control-sm"
                                    value="{{ $prod->price }}">
                            </td>

                            <td>
                                <input type="number" name="stock"
                                    class="form-control form-control-sm"
                                    value="{{ $prod->stock }}">
                            </td>

                            <td>
                                <select name="main_category" class="form-select form-select-sm">
                                    <option value="tefa" {{ $prod->main_category == 'tefa' ? 'selected' : '' }}>TEFA</option>
                                    <option value="mandiri" {{ $prod->main_category == 'mandiri' ? 'selected' : '' }}>Mandiri</option>
                                </select>
                            </td>

                            {{-- EDIT DEPARTMENT --}}
                            <td>
                                <select name="department_id"
                                    class="form-select form-select-sm department-select">
                                    @foreach ($departments as $dep)
                                        <option value="{{ $dep->id }}"
                                            {{ $dep->id == $prod->department_id ? 'selected' : '' }}>
                                            {{ $dep->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            {{-- EDIT SUB DEPARTMENT --}}
                            <td>
                                <select name="sub_department_id"
                                    class="form-select form-select-sm sub-department-select">
                                    @if($prod->subDepartment)
                                        <option value="{{ $prod->subDepartment->id }}" selected>
                                            {{ $prod->subDepartment->name }}
                                        </option>
                                    @else
                                        <option value="">-- Pilih Sub Department --</option>
                                    @endif
                                </select>
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-success btn-sm btn-update">
                                        Update
                                    </button>

                                    <button type="button" class="btn btn-secondary btn-sm btn-cancel">
                                        Cancel
                                    </button>
                                </div>
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


<!-- ini bagian script --> 
    @push('script')
    <script>
    $(document).ready(function () {

        /* ===============================
        TOGGLE EDIT / CANCEL
        =============================== */

        $(document).on('click', '.btn-edit', function () {
            const showRow = $(this).closest('tr.show');
            const editRow = showRow.next('.edit');

            showRow.addClass('d-none');
            editRow.removeClass('d-none');

            // auto load sub department sesuai department aktif
            editRow.find('.department-select').trigger('change');
        });

        $(document).on('click', '.btn-cancel', function () {
            const editRow = $(this).closest('tr.edit');
            editRow.addClass('d-none');
            editRow.prev('.show').removeClass('d-none');
        });


        /* ===============================
        INLINE DEPARTMENT → SUB DEPARTMENT (EDIT TABLE)
        =============================== */

        $(document).on('change', '.department-select', function () {
            const deptId = $(this).val();
            const row = $(this).closest('tr');
            const subSelect = row.find('.sub-department-select');

            subSelect.html('<option value="">Loading...</option>');

            if (!deptId) {
                subSelect.html('<option value="">-- Pilih Sub Department --</option>');
                return;
            }

            $.get(`/get-subdepartments/${deptId}`, function (data) {
                subSelect.empty();
                subSelect.append('<option value="">-- Pilih Sub Department --</option>');
                data.forEach(sub => {
                    subSelect.append(
                        `<option value="${sub.id}">${sub.name}</option>`
                    );
                });
            });
        });


        /* ===============================
        FORM TAMBAH PRODUK (PUNYAMU)
        =============================== */

        $('#department').on('change', function () {
            const deptId = $(this).val();
            const subSelect = $('#sub_department');

            subSelect.html('<option value="">Loading...</option>');

            if (!deptId) {
                subSelect.html('<option value="">-- Pilih Sub Departemen --</option>');
                return;
            }

            $.get(`/get-subdepartments/${deptId}`, function (data) {
                subSelect.empty();
                subSelect.append('<option value="">-- Pilih Sub Departemen --</option>');
                data.forEach(sub => {
                    subSelect.append(
                        `<option value="${sub.id}">${sub.name}</option>`
                    );
                });
            });
        });


        /* ===============================
        UPDATE PRODUK (INI YANG TADI HILANG)
        =============================== */

        $(document).on('click', '.btn-update', function (e) {
            e.preventDefault();

            const row = $(this).closest('tr.edit');
            const id = row.data('id');

            $.ajax({
                url: `/products/${id}`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT',
                    name: row.find('[name="name"]').val(),
                    price: row.find('[name="price"]').val(),
                    stock: row.find('[name="stock"]').val(),
                    main_category: row.find('[name="main_category"]').val(),
                    department_id: row.find('[name="department_id"]').val(),
                    sub_department_id: row.find('[name="sub_department_id"]').val(),
                },
                success: function () {
                    location.reload();
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert('Update produk gagal');
                }
            });
        });

    });
    </script>
    @endpush





