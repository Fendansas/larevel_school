<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 * string $name
 * bigint $id
 * varchar $usertype
 * varchar $email
 * timestamp $email_verified_at
 * varchar $password
 * varchar $remember_token
 * bigint $current_team_id
 * text $profile_photo_path
 * timestamp $created_at
 * timestamp $updated_at
 * varchar $mobile
 * varchar $address
 * varchar $gender
 * varchar $image
 * int $status
 * varchar $fname
 * varchar $mname
 * varchar $religion
 * varchar $id_no
 * date $dob
 * varchar $code
 * varchar $role
 * date $join_date
 * int $designation_id
 * double $
 *
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
