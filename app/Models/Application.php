<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = "applications";
    use HasFactory;

    protected $fillable = [];

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
