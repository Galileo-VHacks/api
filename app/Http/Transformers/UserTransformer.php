<?php

namespace Api\Http\Transformers;

use Cartalyst\Sentinel\Users\EloquentUser;
use Api\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * {@inheritdoc}
     */
    protected $availableIncludes = [];

    /**
     * {@inheritdoc}
     */
    protected $defaultIncludes = [
        'userProfile'
    ];

    /**
     * TripTransformer constructor.
     */
    function __construct()
    {
        //
    }

    /**
     * @param User $user
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'email' => $user->email,
            'created_at' => $user->created_at,
        ];
    }

    public function includeUserProfile(User $user)
    {
        $profile = $user->profile()->first();

        return $this->item($profile, new UserProfileTransformer, 'profile');
    }
}