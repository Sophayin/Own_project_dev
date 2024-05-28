<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;
    public function application_status()
    {
        return $this->hasMany(ApplicationStatus::class, 'reason_id');
    }
    public function application()
    {
        return $this->hasOne(application::class);
    }
}
