<?php
/**
 * Created by PhpStorm.
 * User: pietrobongiovanni
 * Date: 26/10/2017
 * Time: 21:50
 */

namespace Api\Repositories;

use Api\UserProfile;
use Vinkla\Hashids\Facades\Hashids;
use Cartalyst\Sentinel\Users\EloquentUser;
use Api\Contracts\Repositories\UserProfileRepository as UserProfileRepositoryInterface;

class UserProfileRepository extends EloquentRepository implements UserProfileRepositoryInterface
{

    /**
     * @var UserProfile
     */
    protected $model;

    function __construct(UserProfile $model)
    {
        $this->model = $model;
    }

    /**
     * The User
     *
     * @param $user
     *
     * @return mixed
     */
    public function create(EloquentUser $user)
    {
        $attributes = [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
        ];

        $model = $this->model->newInstance($attributes);

        $model->save();
        $referenceCode = Hashids::encode($model->id);
        $model->reference_code = $referenceCode;
        $model->save();

        return $model;
    }
}