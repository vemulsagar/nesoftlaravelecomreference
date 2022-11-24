<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $cascadeDeletes = ['productbrand'];
    public function productbrand(){
        return $this->hasMany(Product::class,'brand_id');
    }
}
