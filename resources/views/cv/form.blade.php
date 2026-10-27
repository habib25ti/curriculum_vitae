<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $mode === 'edit' ? 'Edit CV' : 'Buat CV' }} | Simple Web CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>:root{--gold:#ffc400}body{background:#f5f5f5;font-family:Arial,sans-serif}.panel{background:#fff;border:0;border-radius:10px;box-shadow:0 8px 28px #00000008}.btn-gold{background:var(--gold);border-color:var(--gold);font-weight:700;border-radius:30px;padding:10px 22px}.form-label{font-weight:700}.section-heading{font-size:1.05rem;font-weight:800;border-left:4px solid var(--gold);padding-left:12px}</style>
</head>
<body>
<div class="container py-4 py-lg-5" style="max-width:1000px">
    <div class="d-flex justify-content-between align-items-center mb-4"><div><div class="small text-secondary">SIMPLE WEB CV</div><h1 class="h3 fw-bold mb-0">{{ $mode === 'edit' ? 'Edit Curriculum Vitae' : 'Buat CV Baru' }}</h1></div><a href="{{ route('cv.index') }}" class="btn btn-outline-secondary rounded-pill">← Dashboard</a></div>
    @if($errors->any())<div class="alert alert-danger"><strong>Periksa kembali data:</strong><ul class="mb-0 mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <form class="panel p-4 p-lg-5" method="POST" enctype="multipart/form-data" action="{{ $mode === 'edit' ? route('cv.update',$cv) : route('cv.store') }}">
        @csrf @if($mode === 'edit') @method('PUT') @endif
        <h2 class="section-heading mb-4">1. Informasi Pribadi</h2>
        <div class="row g-3 mb-4">
            <div class="col-md-6"><label class="form-label" for="nama_lengkap">Nama lengkap *</label><input class="form-control" id="nama_lengkap" name="nama_lengkap" maxlength="150" required value="{{ old('nama_lengkap',$cv->nama_lengkap) }}"></div>
            <div class="col-md-6"><label class="form-label" for="profesi">Profesi *</label><input class="form-control" id="profesi" name="profesi" maxlength="100" required placeholder="Contoh: Web Developer" value="{{ old('profesi',$cv->profesi) }}"></div>
            <div class="col-md-6"><label class="form-label" for="email">Email *</label><input class="form-control" type="email" id="email" name="email" maxlength="100" required value="{{ old('email',$cv->email) }}"></div>
            <div class="col-md-6"><label class="form-label" for="no_telp">Nomor telepon *</label><input class="form-control" type="tel" id="no_telp" name="no_telp" pattern="[0-9+\- ()]{8,20}" maxlength="20" required value="{{ old('no_telp',$cv->no_telp) }}"><div class="form-text">Masukkan nomor telepon; tanda +, spasi, kurung, dan strip diperbolehkan.</div></div>
        </div>
        <h2 class="section-heading mb-4">2. Media</h2>
        <div class="row g-3 mb-4">
            <div class="col-md-6"><label class="form-label" for="foto_profil">Foto profil (JPG/PNG, maks. 2 MB)</label><input class="form-control" type="file" id="foto_profil" name="foto_profil" accept=".jpg,.jpeg,.png,image/jpeg,image/png"><div class="form-text">Kosongkan jika tidak ingin mengganti foto.</div>@if($cv->foto_profil)<img class="mt-3 rounded" style="max-width:120px;max-height:120px;object-fit:cover" src="{{ asset('storage/'.$cv->foto_profil) }}" alt="Foto saat ini">@endif</div>
            <div class="col-md-6"><label class="form-label" for="video_url">Link YouTube (opsional)</label><input class="form-control" type="url" id="video_url" name="video_url" maxlength="255" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('video_url', $cv->video_url && str_contains($cv->video_url,'youtube-nocookie.com/embed/') ? $cv->video_url : '') }}"><label class="form-label mt-3" for="video_file">Atau unggah video (MP4/WEBM/MOV, maks. 5 MB)</label><input class="form-control" type="file" id="video_file" name="video_file" accept="video/mp4,video/webm,video/quicktime"></div>
        </div>
        <h2 class="section-heading mb-4">3. Detail CV</h2>
        <div class="mb-3"><label class="form-label" for="tentang_saya">Tentang saya *</label><textarea class="form-control" id="tentang_saya" name="tentang_saya" rows="4" maxlength="5000" required placeholder="Ringkasan profesional dan tujuan karier">{{ old('tentang_saya',$cv->tentang_saya) }}</textarea></div>
        <div class="mb-3"><label class="form-label" for="riwayat_pendidikan">Riwayat pendidikan</label><textarea class="form-control" id="riwayat_pendidikan" name="riwayat_pendidikan" rows="4" maxlength="5000" placeholder="Satu pendidikan per baris, contoh: 2022–2026 | S1 Sistem Informasi | Universitas ...">{{ old('riwayat_pendidikan',$cv->riwayat_pendidikan) }}</textarea></div>
        <div class="mb-4"><label class="form-label" for="keahlian">Keahlian</label><textarea class="form-control" id="keahlian" name="keahlian" rows="3" maxlength="3000" placeholder="PHP, Laravel, MySQL, Bootstrap">{{ old('keahlian',$cv->keahlian) }}</textarea><div class="form-text">Pisahkan keahlian dengan koma atau tulis satu keahlian per baris.</div></div>
        <div class="d-flex flex-wrap gap-2"><button class="btn btn-gold" type="submit">Simpan & Lihat Hasil</button><a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('cv.index') }}">Batal</a></div>
    </form>
</div>
<script>
document.getElementById('foto_profil').addEventListener('change', function () {
    if (this.files[0] && this.files[0].size > 2 * 1024 * 1024) {
        alert('Ukuran foto maksimal 2 MB.'); this.value = '';
    }
});
document.getElementById('video_file').addEventListener('change', function () {
    if (this.files[0] && this.files[0].size > 5 * 1024 * 1024) {
        alert('Ukuran video maksimal 5 MB.'); this.value = '';
    }
});
</script>
</body>
</html>
