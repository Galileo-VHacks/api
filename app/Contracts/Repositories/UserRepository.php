<?php

namespace Api\Contracts\Repositories;

Interface UserRepository
{

    /**
     * @param $emailAddress
     *
     * @return mixed
     */
    public function findByEmail($emailAddress);
}