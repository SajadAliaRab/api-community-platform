<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'image',
        'cover_image',
        'tagline',
        'title',
        'website',
        'mobile',
        'point'
    ];

    public function user():BelongsTo
    {
     return $this->belongsTo(User::class);
    }
}
