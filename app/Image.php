<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'image_path'
    ];


    public function comments()
    {
        // de uno a muchos
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

}
