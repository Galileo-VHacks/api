<?php


$api = app(Dingo\Api\Routing\Router::class);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

$api->version('v1', function ($api) {

    /**
     * User routes
     */
    $api->group([
        'prefix' => 'user',
        'namespace' => 'Api\Http\Controllers',
    ], function ($api) {

        $api->get('/', [
            'as' => 'api.user.currentUser',
            'uses' => 'UserController@currentUser'
        ]);

        $api->post('register', [
            'as' => 'api.user.register',
            'uses' => 'UserController@register'
        ]);

        $api->post('login', [
            'as' => 'api.user.login',
            'uses' => 'UserController@login'
        ]);

        $api->get('logout', [
            'as' => 'api.user.logout',
            'uses' => 'UserController@logout',
        ]);

    });

    $api->group([
        'prefix' => 'activity',
        'namespace' => 'Api\Http\Controllers',
    ], function ($api) {
        $api->get('/', [
            'as' => 'api.activity.index',
            'uses' => 'ActivityController@list',
        ]);
    });

    $api->group([
        'prefix' => 'organization',
        'namespace' => 'Api\Http\Controllers',
    ], function ($api) {
        $api->get('/shelter', [
            'as' => 'api.organization.shelters',
            'uses' => 'OrganizationController@shelters'
        ]);

        $api->get('/pantry', [
            'as' => 'api.organization.food',
            'uses' => 'OrganizationController@food'
        ]);
    });

    $api->group([
        'prefix' => 'transaction',
        'namespace' => 'Api\Http\Controllers',
    ], function ($api) {
        $api->post('/', [
            'as' => 'api.transaction.execute',
            'uses' => 'TransactionController@execute'
        ]);

        $api->get('/', [
            'as' => 'api.transaction.list',
            'uses' => 'TransactionController@list'
        ]);
    });

});