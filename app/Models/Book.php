<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable=['name','summary', 'ISBN', 'img','page_number', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopefindPosts($query, $find) {
        if($find) {
            return $query->where('name','like',"%$find%");
        } else {
            return $query;
        }
    }

    public function scopefilter($query, $categoryId)
    {
        if ($categoryId) {
            return $query->where('city_id', $categoryId);
        }
        return $query;
    }
}
