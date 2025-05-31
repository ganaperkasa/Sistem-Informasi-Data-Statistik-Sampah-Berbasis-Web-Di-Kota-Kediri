<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteEntry extends Model
{
    use HasFactory;

    protected $table = 'waste_entries';

    protected $fillable = [
        'location_id',
        'entry_date',
        'amount_kg',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}

