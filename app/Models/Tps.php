<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;
    protected $fillable = [
        'locations_id', // Foreign key untuk relasi dengan tabel locations
        'jumlah_pekerja',
        'luas',
        'jam_operasional',
        'kapasitas_tps',
        'fasilitas',
        'foto_lokasi',
        'ulasan'
    ];
    protected $table = 'tps'; // Nama tabel yang sesuai dengan migrasi
    public function location()
{
    return $this->belongsTo(Location::class, 'locations_id');
}
}
