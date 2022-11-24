<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CascadeSoftDeletes;
    protected $cascadeDeletes = ['images','assoc','prod_category'];
    protected $dates = ['deleted_at'];
    protected $table="products";

    public function images(){
        return $this->hasMany(ProductImage::class);
    }
    public function assoc(){
        return $this->hasMany(ProductAttributeAssoc::class);
    }
    public function prod_category(){
        return $this->hasMany(ProductCategory::class);
    }
    public function subcat(){
        return $this->belongsTo(SubCategory::class);
    }

}
