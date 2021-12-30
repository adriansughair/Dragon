<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    //
    protected $fillable = [
            'id', 'Nameitem','categories_id'
    ];

    
    public function categories_id()
    {
        return $this->belongsTo('App\Category');
    }

}
