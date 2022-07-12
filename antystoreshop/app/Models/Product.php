<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'description',
        'user_id',
        'category_id',
        'image_name',
        'image_path',
        'status',
    ];

    public function imageDetail()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }


    public  function category(){
        return $this->belongsTo(Categories::class,'category_id');
    }
    public function productImage(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
}
