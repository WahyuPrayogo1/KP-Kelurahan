<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table = 'pekerjaan';
    protected $fillable = ['sektor_id', 'nama', 'jumlah'];

    public function sektor()
    {
        return $this->belongsTo(SektorPekerjaan::class, 'sektor_id');
    }
}

