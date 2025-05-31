<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteOutflow extends Model
{
    use HasFactory;

    protected $table = 'waste_outflows';

    protected $fillable = [
        'location_id',
        'outflow_date',
        'amount_kg',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}

