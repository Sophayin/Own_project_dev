<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    protected $table = "awards";
    use HasFactory;

    protected $fillable = [
        'name', 'description',
    ];

    public function position()
    {
        return $this->hasOne(AwardTarget::class, 'award_id', 'id');
    }
}
