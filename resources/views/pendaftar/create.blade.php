
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 800px">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Formulir Pendaftaran</h4>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pendaftar.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama"
                               value="{{ old('nama') }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIK (16 digit)</label>
                        <input type="text" name="nik"
                               value="{{ old('nik') }}"
                               maxlength="16" inputmode="numeric"
                               class="form-control" required>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control"
                                  required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir"
                               value="{{ old('tempat_lahir') }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir"
                               value="{{ old('tanggal_lahir') }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Hobi</label>
                        <input type="text" name="hobi"
                               value="{{ old('hobi') }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto"
                               accept=".jpg,.jpeg,.png"
                               class="form-control">
                        <small class="text-muted">
                            JPG/PNG, maksimal 2 MB.
                        </small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">No. HP</label>
                        <input type="tel" name="no_hp"
                               value="{{ old('no_hp') }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Ayah</label>
                        <input type="text" name="nama_ayah"
                               value="{{ old('nama_ayah') }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah"
                               value="{{ old('asal_sekolah') }}"
                               class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Pendaftaran
                </button>

                <a href="{{ route('pendaftar.index') }}"
                   class="btn btn-secondary">
                    Lihat Data
                </a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
