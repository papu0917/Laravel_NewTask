<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountbook extends Model
{
    public static $rules = array(
        'price' => 'required',
        'category_id' => 'required',
        'purchase_date' => 'required',
        'title' => 'required'
    );

    protected $fillable = [
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
            ->whereMonth('purchase_date', $now)
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
