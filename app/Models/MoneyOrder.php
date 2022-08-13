<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyOrder extends Model
{
    protected $guareded=[];
    use HasFactory;
    /**
     * Get the user that owns the MoneyOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function famous()
    {
        return $this->belongsTo(Famous::class);
    }
}
