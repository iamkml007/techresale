<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'compare_price',
        'condition', 'grade', 'image', 'stock', 'specifications',
        'accessories_included', 'battery_health', 'is_published', 'category_id', 'brand_id'
    ];
    protected $casts = [
        'images' => 'array',
        'specifications' => 'array',
        'accessories_included' => 'array',
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'is_published' => 'boolean'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function getImagesListAttribute()
    {
        $images = $this->images;
        
        // If null or not array, return empty array
        if (!$images || !is_array($images)) {
            return [];
        }
        
        return $images;
    }
    
    // Check if has multiple images
    public function getHasMultipleImagesAttribute()
    {
        return count($this->images_list) > 1;
    }
    
    // Get image count
    public function getImageCountAttribute()
    {
        return count($this->images_list);
    }
    
    // Get first image URL
    public function getFirstImageUrlAttribute()
    {
        $images = $this->images_list;
        
        if (!empty($images)) {
            return asset($images[0]);
        }
        
        return asset('images/no-image.jpg');
    }
    
    // Get all image URLs
    public function getAllImageUrlsAttribute()
    {
        $images = $this->images_list;
        
        return array_map(function($image) {
            return asset($image);
        }, $images);
    }

    // public function orderItems()
    // {
    //     return $this->hasMany(OrderItem::class);
    // }
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }
    public function getDiscountPercentageAttribute()
    {
        if ($this->compare_price && $this->compare_price > $this->price) {
            return round((($this->compare_price - $this->price) / $this->compare_price) * 100);
        }
        return 0;
    }

    protected static function boot(){
        parent::boot();

        static::deleting(function($product){
            if($product->image && file_exists(public_path('products'.$product->image))){
                unlink(public_path('products'.$product->image));
            }
        });
    }
}
