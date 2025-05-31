<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReduksiSampah extends Model
{
    use HasFactory;

    protected $table = 'reduksi_sampah';

    protected $fillable = [
        'location_id',
        'reduction_date',
        'sampah_masuk',
        'sampah_keluar',
        'reduksi_kg',
        'persentase_reduksi',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}

