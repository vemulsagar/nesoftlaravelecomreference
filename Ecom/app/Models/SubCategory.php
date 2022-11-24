<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CascadeSoftDeletes;
    protected $cascadeDeletes = ['products'];
    protected $dates = ['deleted_at'];
    protected $table="sub_categories";
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
