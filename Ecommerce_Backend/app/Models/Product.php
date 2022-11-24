<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $cascadeDeletes = ['productimages'];
    
    public function productimages(){
        return $this->hasMany(ProductImages::class,'product_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

}
