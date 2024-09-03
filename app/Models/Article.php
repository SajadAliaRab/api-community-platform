<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;
    protected $fillable=[
        'author_id',
        'title',
        'slug',
        'content',
        'image'
    ];
    protected $casts = [
        'image' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class,'author_id');
    }
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable', 'taggable', 'taggable_id', 'tag_id');
    }
    public function ratings()
    {
        return $this->morphMany(Rating::class,'ratable');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }


}
