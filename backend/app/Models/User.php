<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $attributes = [

    'role' =>'user',
    ];
 
    protected $hidden = [
        'password',
    ];

     public function questions(){

     return $this->hasMany(Question::class);
     }
     
     public function responses(){

     return $this->hasMany(Response::class);
     }

     public function favorites(){

    return $this->hasMany(Favorite::class);

     }


    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
