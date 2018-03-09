<?php

namespace Api\Repositories;

use Api\User;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Api\Exceptions\UserAlreadyRegisteredException;
use Api\Contracts\Repositories\UserRepository as UserRepositoryInterface;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{

    protected $model;

    public function __construct(User $model)
    {

        $this->model = $model;
    }

    public function register($email, $password, $firstName, $lastName)
    {
        if($this->findByEmail($email)->first() != null){
            throw new UserAlreadyRegisteredException();
        } else {
            return Sentinel::registerAndActivate([
                'email' => $email,
                'password' => $password,
                'first_name' => $firstName,
                'last_name' => $lastName,
            ]);
        }
    }

    /**
     * @param $emailAddress
     *
     * @return mixed
     */
    public function findByEmail($emailAddress)
    {
        return $this->query()->where([
            'email' => $emailAddress,
        ]);
    }
}