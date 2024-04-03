<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;


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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'phone',
        'is_active'
    ];

    public function getUser($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getUserById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function checkActive($id)
    {
        return $this->where('id', $id)->get('is_active');
    }

    public function activeUser($email)
    {
        return $this->where('email', $email)->update(['is_active' => 1]);
    }

    public function saveUserData($userData)
    {
        return $this->where('id', $userData['id'])->update([
            'name' => $userData['name'], 'address' => $userData['address'], 'city' => $userData['city'], 'phone' => $userData['phone']
        ]);
    }

    public function updatePassword($id, $password)
    {
        return $this->where('id', $id)->update(['password' => $password]);
    }
}
