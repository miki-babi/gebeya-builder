<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'product_id',
        'amount',
        'phone',
        'status',
    ];
    protected $casts = [
        'status' => 'string',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
    public function scopeCanceled($query)
    {
        return $query->where('status', 'canceled');
    }
    public function scopeByProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }
    public function scopeByPhone($query, $phone)
    {
        return $query->where('phone', $phone);
    }
    public function scopeLatest($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->take($limit);
    }
}
