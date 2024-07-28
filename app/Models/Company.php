<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function goldMinings()
    {
        return $this->hasMany(GoldMining::class);
    }
}
