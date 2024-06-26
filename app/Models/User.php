<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'name',
        'npsn',
        'nim',
        'email',
        'password',
        'telp',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Validate the phone number format.
     *
     * @return void
     */
    public function validatePhoneNumber()
    {
        $this->validate([
            'telp' => ['required', 'string', 'regex:/^\d{3}-\d+$/'],
        ], [
            'telp.regex' => 'Nomor telepon harus memiliki 3 angka di depan.'
        ]);
    }

    // public function activeOTP()
    // {
    //     return $this->hasOne(UserOTP::class,'user_id')->where('expired_at','>', 'now()');
    // }
}

