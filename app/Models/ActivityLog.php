<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'action',
        'table_name',
        'user_id',
        'item_id',
        'item_foreign_id',
        'item_name',
        'item_category',
        'item_unit',
        'changed_attributes',
        'item_description',
        'item_in_stock',
        'item_out_stock',
        'item_date'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'item_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'item_id');
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'item_id');
    }

    public function ingredientstock()
    {
        return $this->belongsTo(IngredienStock::class, 'item_id');
    }

    public $timestamps = true;
}
