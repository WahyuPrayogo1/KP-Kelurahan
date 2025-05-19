<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SektorPekerjaan extends Model
{
    protected $table = 'sektor_pekerjaan';
    protected $fillable = ['nama'];

    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class, 'sektor_id');
    }
}
