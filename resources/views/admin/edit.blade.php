<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Data PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Verifikasi Pengajuan PKL</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update', $placement->id) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="alert alert-info">
                            <strong>Data Siswa:</strong><br>
                            Nama: {{ $placement->student->name }} <br>
                            Kelas: {{ $placement->student->class_name }} <br>
                            Perusahaan Tujuan: <strong>{{ $placement->company->name }}</strong>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Pengajuan</label>
                            <select name="status" class="form-select">
                                <option value="pending" {{ $placement->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="approved" {{ $placement->status == 'approved' ? 'selected' : '' }}>Disetujui (ACC)</option>
                                <option value="rejected" {{ $placement->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $placement->start_date }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $placement->end_date }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Nomor Surat Pengantar (Opsional)</label>
                            <input type="text" name="letter_number" class="form-control" 
                                   placeholder="Contoh: 421.5/102/SMK/2024" 
                                   value="{{ $placement->letter_number }}">
                            <div class="form-text">Diisi jika status disetujui dan surat siap dicetak.</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>