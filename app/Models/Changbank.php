<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Changbank extends Model
{
    use HasFactory;
    protected $guareded=[];
    /**
     * Get the user that owns the Changbank
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function famous()
    {
        return $this->belongsTo(Famous::class);
    }

}
