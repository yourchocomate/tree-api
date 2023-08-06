<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    /**
     * Get the owner of the profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
