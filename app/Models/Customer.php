<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function membership()
    {
        return $this->belongsTo(Membership::class);
        // return $this->belongsTo(Membership::class)->select('id', 'name');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function asistances()
    {
        return $this->hasMany(Assistance::class);
    }
    //Scopes
    public function scopeCriterion($query, $criteria, $input)
    {
        if ($criteria == 'income' && $input) {
            return $query->where('income', '>=', date('Y-m-d', strtotime($input)));
        }
        return $query->where($criteria, 'LIKE', "%$input%");
    }


    /*   public function scopeCode($query, $input)
    {
        return $query->where('code', 'LIKE', "%$input%");
    }

    public function scopeIncome($query, $input)
    {
        return $query->where('income', ' >', "$input");
    } */
}
