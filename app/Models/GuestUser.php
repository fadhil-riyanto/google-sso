<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GuestUser extends Authenticatable
{
    protected $table = "guest_user";

    protected $fillable = [
        'name',
        'picture',
        'email',
        'password',
        'token',
        'g_auth_expires_in'
    ];
}
