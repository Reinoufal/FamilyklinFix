<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_method',
        'shipping_address',
        'placed_at',
    ];

    protected $casts = [
        'placed_at' => 'datetime',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('quantity', 'unit_price', 'options');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'order_services')
            ->withPivot('quantity', 'unit_price', 'options');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Kode unik order/invoice
    protected static function booted()
    {
        static::creating(function ($order) {
            if (empty($order->order_code)) {
                $order->order_code = 'INV-' . date('Ymd') . '-' . strtoupper(uniqid());
            }
        });
    }

    public function getOrderCodeAttribute($value)
    {
        return $value ?: 'INV-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
