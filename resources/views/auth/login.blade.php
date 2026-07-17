<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SIM PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h4 class="fw-bold mb-1">SIM PKL</h4>
                        <p class="text-muted mb-0">Login Administrator Hubin</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success py-2">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="admin@simpkl.sch.id" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('registration.index') }}" class="text-muted small">&larr; Kembali ke halaman pendaftaran siswa</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>
