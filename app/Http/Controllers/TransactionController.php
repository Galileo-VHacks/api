<?php

namespace Api\Http\Controllers;

use JsonRpc;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Dingo\Api\Routing\Helpers;
use Api\Exceptions\UserNotLoggedInException;
use Api\Http\Transformers\OrganizationTransformer;
use Api\Http\Requests\Transaction\Execute as TransactionRequest;
use Api\Http\Transformers\UserTransformer;

class TransactionController extends Controller


{
    use Helpers;

    public function __construct()
    {
        JsonRpc::setOptions([
            'version' => config('api.rpc.version'),
            'host' => config('api.rpc.host'),
            'port' => config('api.rpc.port'),
            'assoc' => config('api.rpc.assoc'),
        ]);
    }

    // public function list()
    // {
    //     $version = JsonRpc::web3_clientVersion();

    //     $accounts = JsonRpc::eth_accounts();
    //     foreach ($accounts as $account) {
    //         echo $account, ': ', JsonRpc::eth_getBalance($account, 'latest'), PHP_EOL;
    //     }
    // }

    public function execute(TransactionRequest $request)
    {
        if (!$user = Sentinel::check()) {
            return $this->response()->errorUnauthorized();
        }

        $org = \Api\Organization::where('reference_code', '=', $request->input('to'))->first();
        $wallet = \Api\Wallet::where('user_id', '=', $user->id)->first();

        if ($wallet->balance - $org->price < 0) {
            return $this->response()->errorForbidden();
        }

        $wallet->balance = $wallet->balance - $org->price;
        $wallet->save();

        return $this->item($user, new UserTransformer);
    }

}

