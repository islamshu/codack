<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Famous extends Authenticatable
{
    use HasFactory,HasRoles;
    /**
     * Get the user that owns the Famous
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    
    public function soicals()
    {
        return $this->hasMany(FamousSoial::class);
    }
    /**
     * Get the user associated with the Famous
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bank()
    {
        return $this->hasOne(FamousBank::class);
    }
}
