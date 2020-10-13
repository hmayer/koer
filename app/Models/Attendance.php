<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
}
