<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $fillable =[

        'email',
        'password',
        'role',

    ];
    protected $guard_name = 'Admin';

    protected $hidden = [
        'password',
        'remember_token',
    ];
/**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'id' => $this->id,
                'role' =>$this->role
        ];
    }

}
