<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountbook extends Model
{
    protected $fillable = [   // <---　追加
        'user_id', 'title', 'price', 'id', 'purchase_date', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'accountbook_tag');
    }
}
