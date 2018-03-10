<?php

namespace Api\Http\Controllers;

use JsonRpc;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Dingo\Api\Routing\Helpers;
use Api\Exceptions\UserNotLoggedInException;
use Api\Http\Transformers\OrganizationTransformer;

class OrganizationController extends Controller

{
    use Helpers;

    public function __construct()
    {
        //
    }

    public function shelters()
    {
        if (!$user = Sentinel::check()) {
            return $this->response()->errorUnauthorized();
        }

        $organizations = \Api\Organization::where('type', '=', 'shelter')->get();

        return $this->response()->collection($organizations, new OrganizationTransformer());
    }

    public function food()
    {
        if (!$user = Sentinel::check()) {
            return $this->response()->errorUnauthorized();
        }

        $organizations = \Api\Organization::where('type', '=', 'pantry')->get();

        return $this->response()->collection($organizations, new OrganizationTransformer());
    }

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

