<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = ['nip', 'nama', 'unit_kerja_id'];

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'pegawai_id');
    }
}
