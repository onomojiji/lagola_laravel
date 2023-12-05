<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ["name", "address"];

    public function sellers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Seller::class);
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
