<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran PKL Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Formulir Pendaftaran PKL</h4>
                    </div>
                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('registration.store') }}" method="POST">
                            @csrf <h5 class="mb-3 text-secondary">Data Diri Siswa</h5>
                            
                            <div class="mb-3">
                                <label>NIS (Nomor Induk Siswa)</label>
                                <input type="number" name="nis" class="form-control" placeholder="Contoh: 12345" required>
                            </div>

                            <div class="mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" placeholder="Nama sesuai absen" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Kelas</label>
                                    <select name="class_name" class="form-select" required>
                                        <option value="">Pilih Kelas...</option>
                                        <option value="XII TKR A">XII TKR A</option>
                                        <option value="XII TKR B">XII TKR B</option>
                                        <option value="XII TKR C">XII TKR C</option>
                                        <option value="XII TKR D">XII TKR D</option>
                                        <option value="XII AKL A">XII AKL A</option>
                                        <option value="XII AKL B">XII AKL B</option>
                                        <option value="XII AKL C">XII AKL C</option>
                                        <option value="XII AKL D">XII AKL D</option>
                                        <option value="XII ELIN A">XII STI</option>
                                        <option value="XII ELIN B">XII ELIN B</option>
                                        <option value="XII MLOG A">XII MLOG A</option>
                                        <option value="XII MLOG b">XII MLOG B</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Nomor WhatsApp</label>
                                    <input type="text" name="phone" class="form-control" placeholder="0812..." required>
                                </div>
                            </div>

                            <hr>

                            <h5 class="mb-3 text-secondary">Preferensi Tempat Magang</h5>
                            <div class="mb-3">
                                <label>Pilih Perusahaan / DUDI</label>
                                <select name="company_id" class="form-select" required>
                                    <option value="">-- Pilih Perusahaan --</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">
                                            {{ $company->name }} ({{ $company->address }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text">Pastikan Anda sudah survey lokasi perusahaan tersebut.</div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-lg">Daftar Sekarang</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>