<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamousSoial extends Model
{
    protected $fillable =['famous_id','social_title','social_url'];
    use HasFactory;
}
