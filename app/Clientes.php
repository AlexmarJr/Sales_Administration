<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'id_user','name', 'email', 'telefone','whatsapp','divida_total',
    ];
}
