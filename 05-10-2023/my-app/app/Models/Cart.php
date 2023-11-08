<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table='carts';
     protected $fillable=[
        'user_id',
        'Product_id',
        'product_qty',
        'product_price',
        'product_status',
    ];
    protected $with=['products'];
    public function products()
    {
        return $this->belongsTo(Product::class,'Product_id','id');
    }
}
