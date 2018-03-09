<?php

namespace Api;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    /**
     * {@inheritdoc}
     */
    protected $table = 'user_profiles';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'reference_code',
        'first_name',
        'last_name',
        'location',
        'sex',
        'birthday',
        'trips_created',
        'trips_contacted',
        'profile_picture',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
