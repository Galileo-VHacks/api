<?php

namespace Api\Http\Transformers;

use Cartalyst\Sentinel\Users\EloquentUser;
use Api\Activity;
use League\Fractal\TransformerAbstract;

class ActivityTransformer extends TransformerAbstract
{
    /**
     * {@inheritdoc}
     */
    protected $availableIncludes = [];

    /**
     * {@inheritdoc}
     */
    protected $defaultIncludes = [];

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
    public function transform(Activity $activity)
    {
        return [
            'reference_code' => $activity->reference_code,
            'created_at' => $activity->created_at
        ];
    }

}