<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ar_scene extends Model
{
    protected $table = "ar_scenes";

    protected $fillable =
        [
            'id_user'
            ,'background_route'
            ,'theme'
            ,'description'
            , 'title'
            , 'background_width'
            , 'background_high'
        ];
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function objects()
    {
        return $this->hasMany('App\Object');
    }
}
