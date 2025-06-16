<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'category',
        'is_available',
        'stock_quantity',
    ];
    protected $casts = [
        'image_url' => 'array',
        'category' => 'array',
        'is_available' => 'boolean',
        'stock_quantity' => 'integer',
    ];
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }
    public function scopeByCategory($query, $category)
    {
        return $query->whereJsonContains('category', $category);
    }
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('name', 'like', '%' . $searchTerm . '%')
                     ->orWhere('description', 'like', '%' . $searchTerm . '%');
    }
    public function scopePriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }
    public function scopeLatest($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->take($limit);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
