<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;


class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CascadeSoftDeletes;
    protected $cascadeDeletes = ['subcategory'];
    protected $dates = ['deleted_at'];
    protected $table="categories";
    public function subcategory(){
        return $this->hasMany(SubCategory::class);
    }
}
