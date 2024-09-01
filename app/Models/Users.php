<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Users extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        "id",
        "email",
        "password",
        "full_name"
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Orders::class);
    }
}
