<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'planned_gold_mining'];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
