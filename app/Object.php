<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Object extends Model
{
    protected $table = "objects";

    protected $fillable =
        [
            'id_scene',
            'scale_x',
            'scale_y',
            'scale_z',
            'position_x',
            'position_y',
            'position_z',
            'object_route',
            'texture_route'
        ];
    //
    public function ar_scene()
    {
        return $this->belongsTo('App\Ar_scene');
    }
}
