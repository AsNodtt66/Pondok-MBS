<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

class Notifikasi extends Model
{
    public function notifications()
{
    return $this->hasMany(Notification::class, 'pengguna_id');
}
}