<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Social extends Model
{
    use HasFactory;

    /**
     * Get the user who owns the social
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
