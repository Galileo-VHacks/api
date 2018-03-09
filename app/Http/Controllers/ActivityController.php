<?php

namespace Api\Http\Controllers;

use JsonRpc;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Dingo\Api\Routing\Helpers;
use Api\Http\Transformers\UserTransformer;
use Api\Exceptions\UserNotLoggedInException;
use Api\Http\Transformers\ActivityTransformer;

class ActivityController extends Controller
{
    use Helpers;

    public function __construct()
    {
        //
    }

    // public function list()
    // {
    //     if (!$user = Sentinel::check()) {
    //         return $this->response()->errorUnauthorized();
    //     }

    //     $activities = $user->activity;

    //     return $this->response()->collection($activities, new ActivityTransformer());
    // }

    public function list()
    {
        JsonRpc::setOptions([
        // Geth JSON-RPC version
            'version' => '2.0',
        // Host part of address
            'host' => '127.0.0.1',
        // Port part of address
            'port' => 8545,
        // Return results as associative arrays instead of objects
            'assoc' => true,
        ]);

        // $version = JsonRpc::web3_getVersion();

        $accounts = JsonRpc::eth_accounts();
        foreach ($accounts as $account) {
            echo $account, ': ', JsonRpc::eth_getBalance($account, 'latest'), PHP_EOL;
        }
        // dd(JsonRpc::personal_newAccount('passphrase'));
        // dd(JsonRpc::eth_getBalance('0x0533a29a10c14b63fdade525e4639dab0421314f'));
    }
}

