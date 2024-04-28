<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class IngredientStock extends Model
{
    use HasFactory,Notifiable;
 /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ingredient_id',
        'sales_id',
        'in_stock',
        'out_stock',
        'date',
        'expired_date'
    ];

    public function ingredient(){
        return $this->belongsTo(Ingredient::class,'ingredient_id','id');
    }

    public function penjualan(){
        return $this->belongsTo(Penjualan::class,'sales_id','id');
    }
}
