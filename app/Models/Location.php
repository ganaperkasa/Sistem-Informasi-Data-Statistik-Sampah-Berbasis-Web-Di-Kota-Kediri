<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $fillable = [
        'name',
        'latitude',
        'longitude'
    ];

    public function wasteEntries()
{
    return $this->hasMany(WasteEntry::class);
}

public function wasteOutflows()
{
    return $this->hasMany(WasteOutflow::class);
}

public function reduksiSampah()
{
    return $this->hasMany(ReduksiSampah::class);
}

}
