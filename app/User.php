<?php

namespace Api;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cartalyst\Sentinel\Roles\EloquentRole;

class User extends EloquentUser
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'users';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'email',
        'password',
        'last_name',
        'first_name',
        'permissions',
    ];

    /**
     * {@inheritdoc}
     */
    protected $dates = [];

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

}