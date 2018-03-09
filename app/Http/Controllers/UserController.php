<?php

namespace Api\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Dingo\Api\Routing\Helpers;
use Api\Exceptions\UserAlreadyRegisteredException;
use Api\Http\Requests\User\Register as RegisterRequest;
use Api\Http\Requests\User\Login as LoginRequest;
use Api\Http\Transformers\UserTransformer;
use Api\Jobs\RegisterUser;

class UserController extends Controller
{
    use Helpers;

    public function __construct()
    {
        //
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->dispatchNow(new RegisterUser(
                $request->input('name'),
                $request->input('surname'),
                $request->input('email'),
                $request->input('password')
            ));
        } catch (UserAlreadyRegisteredException $e) {
            return $this->response()->errorForbidden();
        }

        return $this->item($user, new UserTransformer);
    }

    public function login(LoginRequest $request)
    {
        $user = Sentinel::authenticate(array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ));

        return $this->item($user, new UserTransformer);
    }

    public function logout()
    {
        if (!$user = Sentinel::check()) {
            return $this->response()->errorUnauthorized();
        }

        Sentinel::logout();

        return $this->response()->noContent();
    }

}
