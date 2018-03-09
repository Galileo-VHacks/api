<?php

namespace Api\Contracts\Repositories;

use Cartalyst\Sentinel\Users\EloquentUser;

interface UserProfileRepository
{

    /**
     * The User
     *
     * @param $user
     *
     * @return mixed
     */
    public function create(EloquentUser $user);

}

