<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountbook extends Model
{
    protected $fillable = [   // <---　追加
        'user_id', 'title', 'price', 'id', 'purchase_date', 'category_id', 'tag_id',
    ];

    protected $dates = [
        'purchase_date'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'accountbook_tag');
    }

    public static function buildQueryByUser($user, $now)
    {
        $accountbookQuery = self::where('user_id', $user->id)
            ->whereYear('purchase_date', $now)
            // ->whereMonth('purchase_date', $now)
            ->orderBy('purchase_date', 'DESC');
        return $accountbookQuery;
    }

    public static function totalAmountPrice($user)
    {
        $accountbookQuery = self::where('user_id', $user->id)
            ->whereYear('purchase_date', 2020)
            ->orderBy('purchase_date', 'DESC');
        return $accountbookQuery;
    }
}
