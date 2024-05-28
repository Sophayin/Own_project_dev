<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = "positions";
    use HasFactory;

    public function agency()
    {
        return $this->hasMany(Agency::class);
    }

    public function awardTargets()
    {
        return $this->belongsToMany(Award::class, 'award_targets', 'position_id', 'award_id')
            ->withPivot('target_sale', 'target_recruit', 'salary', 'incentive', 'override_fee')->orderBy('award_id');
    }
    public function promote()
    {
        return $this->belongsTo(Promote::class, 'position_id');
    }
}
