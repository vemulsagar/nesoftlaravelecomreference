<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttributeAssoc extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="product_attribute_assocs";
    public function productAssoc(){
        return $this->belongsTo(Product::class);
    }
}
