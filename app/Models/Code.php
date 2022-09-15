<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Code extends Model
{
 
    use SoftDeletes;

    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }
    public function famous(){
        return $this->belongsTo(Famous::class, 'famous_id');
    }
    /**
     * Get all of the comments for the Code
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function add_total()
    {
        return $this->hasMany(AddTotal::class, 'code_id');
    }
    public function add_income()
    {
        return $this->hasMany(AddIncome::class, 'code_id');
    }


}
