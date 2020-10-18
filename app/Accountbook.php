<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountbook extends Model
{
    protected $fillable = [   // <---　追加
        'user_id', 'title', 'price', 'id',
    ];
}
