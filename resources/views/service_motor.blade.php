
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Aplikasi Service Motor</title>
<style>
* { box-sizing: border-box; }
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f1f5f9;
    color: #1e293b;
}
header {
    background: #172554;
    color: white;
    padding: 22px;
}
header h2 { margin: 0 0 6px; }
.layout { display: flex; min-height: 90vh; }
nav {
    width: 220px;
    background: white;
    padding: 15px;
}
nav button {
    display: block;
    width: 100%;
    margin-bottom: 8px;
    padding: 13px;
    border: 0;
    border-radius: 7px;
    text-align: left;
    background: #f1f5f9;
    cursor: pointer;
}
nav button.active {
    background: #1d4ed8;
    color: white;
}
main { flex: 1; padding: 25px; }
.form-section {
    display: none;
    background: white;
    padding: 25px;
    border-radius: 10px;
    max-width: 750px;
}
.form-section.active { display: block; }
label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
}
input, select, textarea {
    width: 100%;
    padding: 11px;
    margin-top: 7px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
}
.save {
    margin-top: 20px;
    padding: 12px 20px;
    border: 0;
    border-radius: 6px;
    background: #1d4ed8;
    color: white;
    cursor: pointer;
}
@media(max-width:650px) {
    .layout { display: block; }
    nav { width: 100%; }
    main { padding: 15px; }
}
</style>
</head>
<body>

<header>
    <h2>🔧 SERVICE MOTOR</h2>
    <p>Sistem Informasi Pengelolaan Bengkel Motor</p>
</header>

<div class="layout">
<nav>
    <button class="active" onclick="showForm('pelanggan',this)">Data Pelanggan</button>
    <button onclick="showForm('kendaraan',this)">Data Kendaraan</button>
    <button onclick="showForm('daftar',this)">Daftar Service</button>
    <button onclick="showForm('data',this)">Data Service</button>
    <button onclick="showForm('bayar',this)">Pembayaran</button>
</nav>

<main>

<section id="pelanggan" class="form-section active">
<h2>Data Pelanggan</h2>
<form action="{{ route('pelanggan.store') }}" method="POST">
@csrf
<label>Nama Lengkap</label>
<input name="nama_lengkap" required>
<label>No HP</label>
<input name="no_hp" required>
<label>Alamat Pelanggan</label>
<textarea name="alamat_pelanggan" required></textarea>
<label>Pekerjaan</label>
<input name="pekerjaan" required>
<button class="save">Simpan Pelanggan</button>
</form>
</section>

<section id="kendaraan" class="form-section">
<h2>Data Kendaraan</h2>
<form action="{{ route('kendaraan.store') }}" method="POST">
@csrf
<label>Nomor Plat</label>
<input name="no_plat" required>
<label>Jenis Kendaraan</label>
<select name="jenis_kendaraan" required>
<option value="">Pilih Kendaraan</option>
<option value="Matic">Matic</option>
<option value="Manual Transmisi">Manual Transmisi</option>
</select>
<label>No STNK</label>
<input name="no_stnk" required>
<label>Tahun Pembuatan</label>
<input type="number" name="tahun_pembuatan" required>
<label>Nama Pemilik</label>
<input name="nama_pemilik" required>
<label>Warna</label>
<input name="warna" required>
<button class="save">Simpan Kendaraan</button>
</form>
</section>

<section id="daftar" class="form-section">
<h2>Daftar Service</h2>
<form action="{{ route('daftar-servis.store') }}" method="POST">
@csrf
<label>Nomor Plat Kendaraan</label>
<select name="kendaraan_id" required>
<option value="">Pilih Kendaraan</option>
@foreach($kendaraans as $k)
<option value="{{ $k->id }}">{{ $k->no_plat }}</option>
@endforeach
</select>
<label>ID Pelanggan</label>
<select name="pelanggan_id" id="pelanggan_id" required>
<option value="">Pilih Pelanggan</option>
@foreach($pelanggans as $p)
<option value="{{ $p->id }}" data-nama="{{ $p->nama_lengkap }}">
{{ $p->id }} - {{ $p->nama_lengkap }}
</option>
@endforeach
</select>
<label>Nama Pelanggan</label>
<input id="nama_pelanggan" readonly>
<label>Keluhan Kendaraan</label>
<textarea name="keluhan_kendaraan" required></textarea>
<label>Tanggal Service</label>
<input type="date" name="tanggal_servis" required>
<button class="save">Simpan Daftar Service</button>
</form>
</section>

<section id="data" class="form-section">
<h2>Data Service</h2>
<form action="{{ route('data-service.store') }}" method="POST">
@csrf
<label>ID Service</label>
<select name="daftar_servis_id" id="pilih_service" required>
<option value="">Pilih ID Service</option>
@foreach($daftarServis as $s)
<option value="{{ $s->id }}" data-keluhan="{{ $s->keluhan_kendaraan }}">
{{ $s->id }} - {{ $s->pelanggan->nama_lengkap ?? 'Pelanggan' }}
</option>
@endforeach
</select>
<label>Keluhan Kendaraan</label>
<input id="keluhan_otomatis" readonly>
<label>Estimasi Service</label>
<input type="number" name="estimasi_service" required>
<label>Nama Mekanik</label>
<input name="nama_mekanik" required>
<label>Sparepart Pengganti</label>
<textarea name="sparepart_pengganti"></textarea>
<button class="save">Simpan Data Service</button>
</form>
</section>

<section id="bayar" class="form-section">
<h2>Pembayaran Service</h2>
<form action="{{ route('pembayaran.store') }}" method="POST">
@csrf
<label>ID Service</label>
<select name="daftar_servis_id" required>
<option value="">Pilih ID Service</option>
@foreach($daftarServis as $s)
<option value="{{ $s->id }}">
{{ $s->id }} - {{ $s->pelanggan->nama_lengkap ?? 'Pelanggan' }}
</option>
@endforeach
</select>
<label>Jumlah Biaya</label>
<input type="number" name="jumlah_biaya_servis" required>
<label>Jenis Pembayaran</label>
<select name="jenis_pembayaran" required>
<option value="">Pilih Pembayaran</option>
<option value="Cash / Tunai">Cash / Tunai</option>
<option value="Non Tunai">Non Tunai</option>
</select>
<label>Keterangan</label>
<textarea name="keterangan"></textarea>
<button class="save">Simpan Pembayaran</button>
</form>
</section>

</main>
</div>

<script>
function showForm(id, button) {
    document.querySelectorAll('.form-section').forEach(el => {
        el.classList.remove('active');
    });
    document.querySelectorAll('nav button').forEach(el => {
        el.classList.remove('active');
    });
    document.getElementById(id).classList.add('active');
    button.classList.add('active');
}

document.getElementById('pelanggan_id').addEventListener('change', function() {
    let option = this.options[this.selectedIndex];
    document.getElementById('nama_pelanggan').value =
        option.dataset.nama || '';
});

document.getElementById('pilih_service').addEventListener('change', function() {
    let option = this.options[this.selectedIndex];
    document.getElementById('keluhan_otomatis').value =
        option.dataset.keluhan || '';
});
</script>

</body>
</html>
