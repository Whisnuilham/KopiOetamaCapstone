<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    protected $fillable = [
        'ingredient_name',
        'category',
        'unit',
    ];
    public function products (){
        return $this-> belongsToMany(
          Product::class,
          'product_ingredient',
          'ingredient_id',
          'product_id',
        ) ->withPivot('quantity')->withTimestamps();;
    }
    public function stocks(){
        return $this-> hasMany(
            IngredientStock::class,
            'ingredient_id',
            'id',
        );
    }
    public function getSumOfStockAttribute(){
        return $this->stocks->sum('in_stock') -$this ->stocks ->sum ('out_stock');
    }
}
