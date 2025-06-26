<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends AuthenticableModelBase
{

    protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'api_token',
        'remember_token',
    ];

   /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'api_token',
        'remember_token',
    ];

       /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function rules($type = "register" | "login"): array
    {
        switch($type) {
            case "register":
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|confirmed|min:8',
                ];
            case "login":
                return [
                    'email' => 'required|string|email',
                    'password' => 'required|string',
                ];
        }

        return [];

    }
}
