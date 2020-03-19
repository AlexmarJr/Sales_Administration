<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'estoques';

    protected $fillable = [
        'id_user','name_product', 'buy_price', 'sell_price','quantity','description','status',
    ];
}
