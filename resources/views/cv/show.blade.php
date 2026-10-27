<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $cv->nama_lengkap }} | CV & Portfolio</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
:root{--gold:#ffc400;--ink:#292929;--muted:#777;--paper:#fff}
*{box-sizing:border-box}body{margin:0;background:#f6f6f6;color:var(--ink);font-family:Arial,Helvetica,sans-serif;font-size:14px}
body:before{content:"";position:fixed;inset:0;pointer-events:none;opacity:.55;background:radial-gradient(circle at 23% 7%,transparent 0 15px,#9ee3a2 16px 18px,transparent 19px),radial-gradient(circle at 99% 5%,transparent 0 18px,#ffdf8d 19px 22px,transparent 23px);z-index:-1}
.cv-layout{max-width:1320px;margin:44px auto;padding:0 24px;display:grid;grid-template-columns:270px minmax(0,1fr);gap:24px}
.profile-card,.top-nav,.content-panel{background:var(--paper);border-radius:5px;box-shadow:0 12px 35px #00000008;overflow:hidden}
.profile-card{align-self:start;position:sticky;top:24px}.profile-name{padding:18px 20px 14px}.profile-name h1{font-size:15px;font-weight:800;text-transform:uppercase;margin:0 0 3px}.profile-name p{font-size:12px;color:var(--muted);margin:0}.profile-photo{width:100%;height:205px;object-fit:cover;background:#eee}.profile-info{padding:28px 22px 24px}.profile-info ul{list-style:none;padding:0;margin:0}.profile-info li{position:relative;padding:0 0 16px 20px;color:#666;font-size:12px;overflow-wrap:anywhere}.profile-info li:before{content:"";position:absolute;left:3px;top:4px;width:7px;height:7px;border:2px solid var(--gold);border-radius:50%;background:white}.profile-info strong{color:#222}.round-icon{width:34px;height:34px;border-radius:50%;background:var(--gold);display:grid;place-items:center;margin-top:-44px;position:relative;margin-bottom:26px;color:#111}
.main-area{min-width:0}.top-nav{display:flex;align-items:center;min-height:54px;margin-bottom:28px}.home-mark{align-self:stretch;display:grid;place-items:center;width:52px;background:var(--gold);color:#111;font-size:18px}.nav-links{display:flex;align-items:center;gap:20px;padding:0 20px;flex:1;flex-wrap:wrap}.nav-links a{color:#222;text-decoration:none;text-transform:uppercase;font-size:11px;font-weight:800}.hire{background:var(--gold);border-radius:30px;padding:9px 17px;color:#111;text-decoration:none;font-weight:700;font-size:12px;margin-right:14px;white-space:nowrap}
.content-panel{padding:34px 30px}.section-title{font-size:15px;font-weight:800;margin:0 0 24px}.section-title span{box-shadow:inset 0 -6px #ffe4a0}.about-text{font-size:12px;line-height:1.9;color:#555;white-space:pre-line}.services{background:#fafafa;margin:30px -30px -34px;padding:34px 30px}.skill-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:20px}.skill-card{background:#fff;border-radius:7px;padding:20px 15px;box-shadow:0 5px 20px #00000008;min-height:135px}.skill-card i{font-size:28px;margin-bottom:14px;color:#333}.skill-card h3{font-size:12px;font-weight:800}.skill-card p{font-size:11px;color:#777;line-height:1.5;margin:0;overflow-wrap:anywhere}.detail-section{margin-top:36px}.detail-section p,.detail-section li{font-size:13px;line-height:1.8;color:#555;white-space:pre-line}.skill-tags{display:flex;flex-wrap:wrap;gap:8px}.skill-tag{background:#fff4c8;border-radius:20px;padding:7px 12px;font-size:12px}.video-frame{width:100%;aspect-ratio:16/9;border:0;border-radius:8px}.floating-actions{position:fixed;right:22px;bottom:22px;display:flex;gap:10px;z-index:10}.floating-actions a,.floating-actions button{border:0;border-radius:28px;padding:12px 18px;background:var(--gold);color:#111;text-decoration:none;font-weight:700;box-shadow:0 5px 18px #0002}.floating-actions .back{background:#fff}
@media(max-width:900px){.cv-layout{grid-template-columns:220px minmax(0,1fr);padding:0 16px;gap:16px;margin:20px auto}.skill-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.nav-links{gap:12px;padding:0 12px}.content-panel{padding:26px 22px}.services{margin:26px -22px -26px;padding:26px 22px}}
@media(max-width:640px){.cv-layout{display:flex;flex-direction:column;margin:12px auto}.profile-card{position:static;width:100%}.profile-photo{height:260px}.top-nav{flex-wrap:wrap}.nav-links{padding:12px;gap:12px}.home-mark{height:45px}.hire{margin:8px 12px 8px auto}.content-panel{padding:24px 18px}.services{margin:24px -18px -24px;padding:24px 18px}.skill-grid{gap:10px}.floating-actions{left:12px;right:12px;bottom:12px}.floating-actions a,.floating-actions button{flex:1;text-align:center;padding:11px 8px;font-size:12px}}
@media print{body{background:#fff;font-size:11px}.cv-layout{max-width:none;margin:0;padding:0;grid-template-columns:210px 1fr;gap:14px}.profile-card,.top-nav,.content-panel{box-shadow:none;border:1px solid #eee}.profile-card{position:static}.top-nav{display:none}.content-panel{padding:20px}.services{background:#fff}.floating-actions{display:none}.skill-card{box-shadow:none;border:1px solid #eee;break-inside:avoid}.detail-section{break-inside:avoid}a{color:inherit;text-decoration:none}}
</style>
</head>
<body>
<div class="cv-layout">
    <aside class="profile-card">
        <div class="profile-name"><h1>{{ $cv->nama_lengkap }}</h1><p>{{ $cv->profesi }}</p></div>
        @if($cv->foto_profil)
            <img class="profile-photo" src="{{ asset('storage/'.$cv->foto_profil) }}" alt="Foto {{ $cv->nama_lengkap }}">
        @else
            <div class="profile-photo d-flex align-items-center justify-content-center display-1 fw-bold">{{ strtoupper(substr($cv->nama_lengkap,0,1)) }}</div>
        @endif
        <div class="profile-info"><div class="round-icon"><i class="fa-regular fa-id-card"></i></div>
            <ul>
                <li><strong>Nama:</strong> {{ $cv->nama_lengkap }}</li>
                <li><strong>Profesi:</strong> {{ $cv->profesi }}</li>
                <li><strong>Email:</strong> {{ $cv->email }}</li>
                <li><strong>Telepon:</strong> {{ $cv->no_telp }}</li>
            </ul>
            <button class="btn btn-sm mt-2 rounded-pill fw-bold px-3" style="background:var(--gold)" onclick="window.print()">Cetak CV <i class="fa-solid fa-download ms-1"></i></button>
        </div>
    </aside>
    <main class="main-area">
        <nav class="top-nav">
            <div class="home-mark"><i class="fa-solid fa-house"></i></div>
            <div class="nav-links"><a href="#tentang">Tentang Saya</a><a href="#pendidikan">Pendidikan</a><a href="#keahlian">Keahlian</a>@if($cv->video_url)<a href="#video">Video</a>@endif</div>
            <a class="hire" href="mailto:{{ $cv->email }}">Hubungi Saya <i class="fa-solid fa-paper-plane ms-1"></i></a>
        </nav>
        <section class="content-panel" id="tentang">
            <h2 class="section-title"><span>About Me</span></h2>
            <div class="about-text">{{ $cv->tentang_saya }}</div>
            <div class="services" id="keahlian">
                <h2 class="section-title"><span>My Skills</span></h2>
                @php($skills = preg_split('/[,;\n]+/', $cv->keahlian ?? '', -1, PREG_SPLIT_NO_EMPTY))
                @if(count($skills))
                    <div class="skill-grid">
                        @foreach(array_slice($skills,0,8) as $skill)
                            <article class="skill-card"><i class="fa-solid fa-laptop-code"></i><h3>{{ trim($skill) }}</h3><p>Keahlian profesional</p></article>
                        @endforeach
                    </div>
                @else
                    <p class="text-secondary small mb-0">Keahlian belum ditambahkan.</p>
                @endif
            </div>
            <section class="detail-section" id="pendidikan"><h2 class="section-title"><span>Education</span></h2>
                @if($cv->riwayat_pendidikan)
                    <p>{{ $cv->riwayat_pendidikan }}</p>
                @else
                    <p>Riwayat pendidikan belum ditambahkan.</p>
                @endif
            </section>
            @if($cv->video_url)
                <section class="detail-section" id="video"><h2 class="section-title"><span>Video Perkenalan</span></h2>
                    @if(str_contains($cv->video_url,'youtube-nocookie.com/embed/'))
                        <iframe class="video-frame" src="{{ $cv->video_url }}" title="Video perkenalan" allowfullscreen loading="lazy"></iframe>
                    @elseif(filter_var($cv->video_url,FILTER_VALIDATE_URL))
                        <a href="{{ $cv->video_url }}" target="_blank" rel="noopener">Tonton video perkenalan</a>
                    @else
                        <video class="video-frame" controls src="{{ asset('storage/'.$cv->video_url) }}"></video>
                    @endif
                </section>
            @endif
        </section>
    </main>
</div>
<div class="floating-actions"><a class="back" href="{{ route('cv.index') }}">← Dashboard</a><button onclick="window.print()">Print PDF <i class="fa-solid fa-file-pdf ms-1"></i></button></div>
</body>
</html>
