<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'category',
        'sold',
        'date',
    ];

    protected $casts = [

        'date' => 'date:d-M-Y',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
