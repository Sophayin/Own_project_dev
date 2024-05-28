<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardTarget extends Model
{
    protected $table = "award_targets";
    use HasFactory;

    public function award()
    {
        return $this->belongsTo(Award::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
}
