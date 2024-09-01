<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdersItems extends Model
{
    protected $table = "orders_items";
    protected $primaryKey = "id";
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "id",
        "order_id",
        "product_id",
        "quantity",
        "price",
    ];

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Orders::class);
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Products::class);
    }
}
