<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Stores extends Model
{
    use HasFactory ,HasTranslations;
    public $translatable = ['title'];
    protected $guareded=[];
    /**
     * Get the user that owns the Stores
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,'added_by');
    }
    /**
     * Get all of the comments for the Stores
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function codes()
    {
        return $this->hasMany(Code::class,'store_id');
    }
}
