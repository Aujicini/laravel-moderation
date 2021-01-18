<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Aujicini\Moderation\Traits\Bannable;

class User extends Model implements AuthorizableContract, AuthenticatableContract
{
    use Authenticatable;
    use Authorizable;
    use Bannable;

    protected $fillable = ['email'];

    public $timestamps = false;

    protected $table = 'users';
}
