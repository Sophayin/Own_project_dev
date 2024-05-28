<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    protected $table="occupations";
    
    use HasFactory;
    public function application()
    {
        return $this->hasOne(Application::class);
    }
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
