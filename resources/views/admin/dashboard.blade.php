<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIM PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Administrator Hubin</a>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Data Masuk Penempatan Siswa</h5>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal Daftar</th>
                                <th>Nama Siswa / Kelas</th>
                                <th>Perusahaan Pilihan</th>
                                <th>Kontak Siswa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($placements as $item)
                            <tr>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                
                                <td>
                                    <strong>{{ $item->student->name }}</strong><br>
                                    <small class="text-muted">{{ $item->student->nis }} - {{ $item->student->class_name }}</small>
                                </td>
                                
                                <td>
                                    {{ $item->company->name }} <br>
                                    <small class="text-muted">{{ $item->company->address }}</small>
                                </td>

                                <td>{{ $item->student->phone }}</td>

                                <td>
                                    @if($item->status == 'pending')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif($item->status == 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                        Verifikasi
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                            Edit
                                        </a>

                                        @if($item->status == 'approved')
                                            <a href="{{ route('admin.print', $item->id) }}" class="btn btn-sm btn-danger" target="_blank">
                                                Cetak PDF
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Belum ada data pendaftaran siswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>
</html>