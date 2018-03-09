<?php

namespace Api\Http\Transformers;

use Api\UserProfile;
use League\Fractal\TransformerAbstract;

class UserProfileTransformer extends TransformerAbstract
{
    /**
     * {@inheritdoc}
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * {@inheritdoc}
     */
    protected $defaultIncludes = [
        //
    ];

    public function transform(UserProfile $userProfile)
    {

        return [
            'first_name' => $userProfile->first_name,
            'last_name' => $userProfile->last_name,
            'location' => $userProfile->lastName,
            'sex' => $userProfile->sex,
            'birthday' => $userProfile->birthday,
            //TODO: multiple sizes, transformations
            'profile_picture' => $userProfile->profile_picture,
        ];

    }

}
