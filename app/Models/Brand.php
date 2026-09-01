<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image'
    ];
    
    // Relationship with products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('brands/' . $this->image);
        }
        return asset('frontend/images/no-image.jpg');
    }
}