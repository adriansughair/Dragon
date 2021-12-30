<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{

    /**
     * Get the user of real estate.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the user of real estate.
     */
    public function gallery()
    {
        return $this->hasMany('App\Gallery');
    }

    /**
     * Get all comments of real estate.
     */
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get Likes of real estate.
     */
    public function like() {
        return $this->hasOne('App\Like');
    }

    /**
     * Get Likes of real estate.
     */
    public function likes() {
        return $this->hasMany('App\Like');
    }
}
