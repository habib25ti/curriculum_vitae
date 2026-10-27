<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $table = 'tbl_cv';

    protected $fillable = [
        'nama_lengkap',
        'profesi',
        'email',
        'no_telp',
        'tentang_saya',
        'riwayat_pendidikan',
        'keahlian',
        'foto_profil',
        'video_url',
    ];
}
