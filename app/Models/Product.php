<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'category_id',
        'description',
    ];
    public function category(){
        return $this ->belongsTo(Category::class,'category_id','id');
    }
    public function ingredients (){
        return $this-> belongsToMany(
          IngredientStock::class,
          'product_ingredient',
          'product_id',
          'ingredient_id',
        );
    }
}
