<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = array('id');
    protected $fillable = ['name'];

    public static $rules = array(
        'name' => 'required',
    );

    public function accountbooks()
    {
        return $this->belongsToMany('App\Accountbook', 'accountbook_tag');
    }
}
