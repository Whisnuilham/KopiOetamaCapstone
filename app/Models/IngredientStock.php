<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientStock extends Model
{
    use HasFactory;
 /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ingredient_id',
        'in_stock',
        'out_stock',
        'date',
    ];

    public function ingredient(){
        return $this->belongsTo(Ingredient::class,'ingredient_id','id');
    }
}
