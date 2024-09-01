<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    protected $table = "orders";
    protected $primaryKey = "id";
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "id",
        "user_id",
        "total_amount",
        "status"
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class);
    }

    public function ordersItems(): HasMany
    {
        return $this->hasMany(OrdersItems::class);
    }
}
