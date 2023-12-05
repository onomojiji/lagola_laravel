<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ["avatar", "name", "price", "category_id", "purchase_price"];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function commands(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Command::class);
    }

    public function companyProducts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CompanyHasProduct::class);
    }

    public function pertes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Perte::class);
    }
}
