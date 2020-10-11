<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saved extends Model
{
    protected $table = 'saved';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'saved_id', 'user_id'
    ];
}
