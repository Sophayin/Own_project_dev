<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollDetail extends Model
{
    use HasFactory;

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'id');
    }
}