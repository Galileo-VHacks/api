<?php

namespace Api\Http\Transformers;

use Cartalyst\Sentinel\Users\EloquentUser;
use Api\Organization;
use League\Fractal\TransformerAbstract;

class OrganizationTransformer extends TransformerAbstract
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
    public function transform(Organization $organization)
    {
        return [
            'id' => $organization->id,
            'reference_code' => $organization->reference_code,
            'name' => $organization->name,
            'wallet' => $organization->wallet,
            'email' => $organization->email,
            'phone' => $organization->phone_number,
            'website' => $organization->website,
            'type' => $organization->type,
            'location' => $this->getLocation($organization),
            'created_at' => $organization->created_at
        ];
    }

    private function getLocation(Organization $organization)
    {
        return [
            'lat' => $organization->lat,
            'long' => $organization->long,
        ];
    }

}