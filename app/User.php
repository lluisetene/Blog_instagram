<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'username', 'email', 'password', 'image_path', 'private_account'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Retorna todas las imágenes del usuario
    public function images()
    {
        // de uno a muchos
        return $this->hasMany('App\Image');
    }

    // Seguidos
    public function followeds()
    {
        return $this->hasMany('App\Follower');
    }

    // Seguidores
    public function followers()
    {
        return $this->hasMany('App\Follower', 'toUser_id');
    }

    // Última imagen subida por el usuario
    public function lastImgUpload()
    {
        return $this->hasMany('App\Image')->orderBy('id', 'desc')->first();
    }

    // Imágenes que tiene guardadas de otros usuarios
    public function imagesSaved()
    {
        return $this->hasMany('App\Saved', 'user_id');
    }

}
