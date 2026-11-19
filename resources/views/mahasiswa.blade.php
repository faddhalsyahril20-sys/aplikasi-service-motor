<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>

    <h1>Data Mahasiswa</h1>

    @foreach ($mahasiswa as $mhs)
        <p>
            NIM: {{ $mhs->nim }} <br>
            Nama: {{ $mhs->nama }} <br>
            Jurusan: {{ $mhs->jurusan }}
        </p>

        <hr>
    @endforeach

</body>
</html>