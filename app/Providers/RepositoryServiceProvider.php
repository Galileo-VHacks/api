<?php

namespace Api\Providers;

use Api\Repositories\TripRepository;
use Illuminate\Support\ServiceProvider;
use Api\Contracts\Repositories\TripRepository as TripRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $repositoryBindings = $this->getRepositoryBindings();

        foreach ($repositoryBindings as $interface => $concrete) {
            $this->app->bind($interface, $concrete);
        }
    }

    /**
     * Get the bindings of the repositories.
     *
     * @return array
     */
    private function getRepositoryBindings()
    {
        return [
            TripRepositoryInterface::class => TripRepository::class,
        ];
    }
}
