<?php

namespace App\Models;

use App\Models\ProductDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function detail()
    {
        return $this->hasOne(ProductDetails::class, 'product_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function image(){
        return $this->morphOne(Image::class, 'imagable');
    }
}
