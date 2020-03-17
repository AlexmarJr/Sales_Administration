<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    protected $table = 'vendas';

    protected $fillable = [
        'id_client','product', 'original_price', 'current_price','latest_paiment','description','status',
    ];
}
