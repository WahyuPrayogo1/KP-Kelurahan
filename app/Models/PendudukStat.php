<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendudukStat extends Model
{
    use HasFactory;
    protected $table = 'penduduk_stats';
    protected $fillable = ['laki_laki', 'perempuan','tahun'];
}
