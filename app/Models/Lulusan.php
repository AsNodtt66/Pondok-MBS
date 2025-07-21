<?php

namespace App\Models;

use App\Models\Alumni;
use Illuminate\Database\Eloquent\Model;

class Lulusan extends Model
{
    protected $table = 'lulusans';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'Alumni_id', 'Tahun_lulus', 'Jurusan'
    ];

    // Relasi dengan Alumni (One-to-One)
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'Alumni_id');
    }
}