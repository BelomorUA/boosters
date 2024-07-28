<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoldMining extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'date_time', 'weight'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
