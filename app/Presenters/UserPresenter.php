<?php

namespace Api\Presenters;

use Laracasts\Presenter\Presenter;
use JsonRpc;

class UserPresenter extends Presenter
{

    public function balance()
    {
        JsonRpc::setOptions([
            'version' => config('api.rpc.version'),
            'host' => config('api.rpc.host'),
            'port' => config('api.rpc.port'),
            'assoc' => config('api.rpc.assoc'),
        ]);

        return JsonRpc::eth_getBalance($this->wallet, 'latest');
    }

}