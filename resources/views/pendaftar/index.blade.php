
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container-fluid py-4">
    <h3>Data Pendaftar</h3>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('pendaftar.create') }}"
       class="btn btn-primary mb-3">+ Tambah Pendaftar</a>

    <div class="table-responsive bg-white">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Hobi</th>
                    <th>Foto</th>
                    <th>No. HP</th>
                    <th>Email</th>
                    <th>Nama Ayah</th>
                    <th>Asal Sekolah</th>
                    <th>NIK</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendaftars as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>{{ $p->tempat_lahir }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d/m/Y') }}</td>
                        <td>{{ $p->hobi }}</td>
                        <td>
                            @if ($p->foto)
                                <img src="{{ asset('storage/'.$p->foto) }}"
                                     width="65" alt="Foto pendaftar">
                            @else
                                Belum ada foto
                            @endif
                        </td>
                        <td>{{ $p->no_hp }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->nama_ayah }}</td>
                        <td>{{ $p->asal_sekolah }}</td>
                        <td>{{ $p->nik }}</td>
                        <td>
                            <a href="{{ route('pendaftar.edit', $p->id) }}"
                               class="btn btn-warning btn-sm mb-1">Edit</a>

                            <form action="{{ route('pendaftar.destroy', $p->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center">
                            Belum ada data pendaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
