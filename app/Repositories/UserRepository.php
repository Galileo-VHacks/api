<?php

namespace Api\Repositories;

use Api\User;
use JsonRpc;
use Config;
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

        if ($this->findByEmail($email)->first() != null) {
            throw new UserAlreadyRegisteredException();
        }

        JsonRpc::setOptions([
            'version' => config('api.rpc.version'),
            'host' => config('api.rpc.host'),
            'port' => config('api.rpc.port'),
            'assoc' => config('api.rpc.assoc'),
        ]);

        $user = Sentinel::registerAndActivate([
            'email' => $email,
            'password' => $password,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'wallet' => JsonRpc::personal_newAccount($password),
        ]);

        return $user;
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