<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        "destination_id",
        "user_id",
        "rating",
        "comment"
    ];

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }
}
