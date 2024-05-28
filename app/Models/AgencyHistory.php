<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyHistory extends Model
{
    protected $table = "agency_histories";
    use HasFactory;
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
