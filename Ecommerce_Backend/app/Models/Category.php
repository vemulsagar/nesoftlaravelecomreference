<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    /** need to install cascadesoftdeletes trait
     * $ composer require dyrynda/laravel-cascade-soft-deletes */
    protected $cascadeDeletes = ['subcategories','productcategory'];
    public function subcategories(){
        return $this->hasMany(SubCategory::class,'category_id');
    }

    public function productcategory(){
        return $this->hasMany(Product::class,'category_id');
    }

   
}
