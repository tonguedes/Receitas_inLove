<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable=['title','description','ingredients','instructions','image','category_id','user_id'];
    

public function user() {
    return $this->belongsTo(User::class);
}

public function category() {
    return $this->belongsTo(Category::class);
}

public function comments() {
    return $this->hasMany(Comment::class);
}


public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
}

// escopo de contagem
public function scopeMostFavorited($query, $limit = 10)
{
    return $query->withCount('favoritedBy')
                 ->whereHas('favoritedBy')
                 ->orderByDesc('favorited_by_count')
                 ->take($limit);
}


}