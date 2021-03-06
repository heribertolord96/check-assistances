<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    public function assistances()
    {
        return $this->hasMany(Assistance::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
