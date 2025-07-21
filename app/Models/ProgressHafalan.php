<?php

namespace App\Models;

use App\Models\Santri;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Model;

class ProgressHafalan extends Model
{
    protected $table = 'progress_hafalan';

    protected $fillable = ['Santri_id','Juz', 'Surah', 'Ayat_mulai', 'Ayat_selesai', 'Tanggal_setor', 'Status_setor'];
    protected $dates = ['Tanggal_setor'];

    protected $casts = [
    'Tanggal_setor' => 'datetime',
];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'Santri_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'Pengguna_id');
    }
}