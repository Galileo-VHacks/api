<?php

namespace Api;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Api\Presenters\UserPresenter;
use Laracasts\Presenter\PresentableTrait;
use Api\Wallet;

class User extends EloquentUser
{
    use PresentableTrait;

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
        'wallet',
        'is_organization',
    ];

    /**
     * The presenter
     *
     * @var UserPresenter
     */
    protected $presenter = UserPresenter::class;

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

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

}