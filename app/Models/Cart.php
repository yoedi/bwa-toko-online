<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'user_id'
    ];

    protected $hidden = [

    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
