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

    public static function totalAmountPrice($user, $request)
    {
        $accountbookQuery = self::where('user_id', $user->id)
            ->whereYear('purchase_date', 2020)
            ->whereMonth('purchase_date', $request->purcahse_date_month)
            ->orderBy('purchase_date', 'DESC');
        return $accountbookQuery;
    }

    public static function totalAmountCategory($user, $request)
    {
        $accountbookByCategory = self::where('user_id', $user->id)
            ->where('category_id', $request->category_id)
            ->orderBy('category_id', 'DESC');
        return $accountbookByCategory;
    }

    public static function totalAmountTag($user)
    {
        $accountbookByTag = self::where('user_id', $user->id);
        return $accountbookByTag;
    }
}

// CLEARDB_DATABASE_URL:
// mysql: //bf9e01a41c1c3a:8e667554@us-cdbr-east-02.cleardb.com/heroku_146e188c3a77c93?reconnect=true
// CLEARDB_NAVY_URL:
// mysql://b88c95fbd65f9d:faca93ea@us-cdbr-east-02.cleardb.com/heroku_32c95f6e1727cfb?reconnect=true
// mysql://bf9e01a41c1c3a:8e667554@us-cdbr-east-02.cleardb.com/heroku_146e188c3a77c93?reconnect=true