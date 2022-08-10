<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
 
    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }
    public function famous(){
        return $this->belongsTo(Famous::class, 'famous_id');
    }
}
