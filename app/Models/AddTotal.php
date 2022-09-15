<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddTotal extends Model
{
    use HasFactory;
    protected $guareded=[];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
