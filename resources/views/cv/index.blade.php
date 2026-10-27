<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard CV | Simple Web CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root{--gold:#ffc400;--ink:#252525;--muted:#777}
        body{background:#f5f5f5;color:var(--ink);font-family:Arial,sans-serif}
        .topbar,.panel,.cv-card{background:#fff;border:0;border-radius:8px;box-shadow:0 8px 28px #00000008}
        .brand-mark{background:var(--gold);padding:18px 22px;border-radius:8px 0 0 8px}
        .btn-gold{background:var(--gold);border-color:var(--gold);font-weight:700;border-radius:30px;padding:10px 20px}
        .btn-gold:hover{background:#edb700;border-color:#edb700}
        .avatar{width:72px;height:72px;object-fit:cover;border-radius:50%;background:#eee}
        .muted{color:var(--muted)}
        .section-title{font-size:1.05rem;font-weight:800;margin-bottom:1.25rem}
        .section-title span{box-shadow:inset 0 -7px #ffe7a0}
    </style>
</head>
<body>
<div class="container py-4 py-lg-5">
    <header class="topbar d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3"><div class="brand-mark">⌂</div><div><strong>SIMPLE WEB CV</strong><div class="small muted">CV & Portfolio Dashboard</div></div></div>
        <a href="{{ route('cv.create') }}" class="btn btn-gold me-3">+ Buat CV Baru</a>
    </header>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <section class="panel p-4 p-lg-5 mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">
            <div><div class="section-title"><span>Dashboard CV</span></div><h1 class="h3 fw-bold mb-1">Daftar Curriculum Vitae</h1><p class="muted mb-0">Kelola, lihat, dan perbarui CV dalam satu tempat.</p></div>
            <span class="badge text-bg-light p-2">{{ $cvs->total() }} CV tersimpan</span>
        </div>
    </section>

    <!-- Tabel admin: semua CV yang tersimpan -->
    <section class="panel p-4 mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <div class="section-title mb-1"><span>Data CV</span></div>
                <p class="muted small mb-0">Daftar CV yang sudah dibuat beserta tindakan CRUD.</p>
            </div>
            <a href="{{ route('cv.create') }}" class="btn btn-gold btn-sm">+ Tambah CV</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="min-width:60px">No.</th>
                        <th style="min-width:190px">Nama Lengkap</th>
                        <th style="min-width:150px">Profesi</th>
                        <th style="min-width:210px">Email</th>
                        <th style="min-width:140px">No. Telepon</th>
                        <th style="min-width:150px">Tanggal Dibuat</th>
                        <th style="min-width:210px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cvs as $cv)
                        <tr>
                            <td>{{ $cvs->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($cv->foto_profil)
                                        <img class="avatar" style="width:42px;height:42px" src="{{ asset('storage/'.$cv->foto_profil) }}" alt="Foto {{ $cv->nama_lengkap }}">
                                    @else
                                        <div class="avatar d-flex align-items-center justify-content-center fw-bold" style="width:42px;height:42px">{{ strtoupper(substr($cv->nama_lengkap,0,1)) }}</div>
                                    @endif
                                    <span class="fw-semibold">{{ $cv->nama_lengkap }}</span>
                                </div>
                            </td>
                            <td>{{ $cv->profesi }}</td>
                            <td>{{ $cv->email }}</td>
                            <td>{{ $cv->no_telp }}</td>
                            <td>{{ $cv->created_at ? $cv->created_at->format('d-m-Y H:i') : '-' }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a class="btn btn-sm btn-gold" href="{{ route('cv.show', $cv) }}">Lihat</a>
                                    <a class="btn btn-sm btn-outline-primary rounded-pill" href="{{ route('cv.edit', $cv) }}">Edit</a>
                                    <form action="{{ route('cv.destroy', $cv) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus CV {{ addslashes($cv->nama_lengkap) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-5 text-secondary">Belum ada data CV. Klik “Tambah CV” untuk membuat CV pertama.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-3">
            <small class="muted">Menampilkan {{ $cvs->firstItem() ?? 0 }}–{{ $cvs->lastItem() ?? 0 }} dari {{ $cvs->total() }} CV</small>
            {{ $cvs->links() }}
        </div>
    </section>

    <div class="row g-4">
        @forelse($cvs as $cv)
            <div class="col-12 col-md-6 col-xl-4">
                <article class="cv-card p-4 h-100">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        @if($cv->foto_profil)
                            <img class="avatar" src="{{ asset('storage/'.$cv->foto_profil) }}" alt="Foto {{ $cv->nama_lengkap }}">
                        @else
                            <div class="avatar d-flex align-items-center justify-content-center fw-bold fs-3">{{ strtoupper(substr($cv->nama_lengkap,0,1)) }}</div>
                        @endif
                        <div class="min-w-0"><h2 class="h5 fw-bold mb-1 text-truncate">{{ $cv->nama_lengkap }}</h2><div class="muted small">{{ $cv->profesi }}</div><div class="small text-truncate">{{ $cv->email }}</div></div>
                    </div>
                    <p class="muted small">{{ \Illuminate\Support\Str::limit($cv->tentang_saya, 125) }}</p>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <a class="btn btn-sm btn-gold" href="{{ route('cv.show',$cv) }}">Lihat CV</a>
                        <a class="btn btn-sm btn-outline-secondary rounded-pill" href="{{ route('cv.edit',$cv) }}">Edit</a>
                        <form action="{{ route('cv.destroy',$cv) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus CV ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger rounded-pill">Hapus</button></form>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12"><div class="panel p-5 text-center"><h2 class="h5">Belum ada CV</h2><p class="muted">Mulai dengan membuat CV pertama Anda.</p><a href="{{ route('cv.create') }}" class="btn btn-gold">Buat CV Baru</a></div></div>
        @endforelse
    </div>
</div>
</body>
</html>
