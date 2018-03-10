<?php

use Illuminate\Foundation\Inspiring;
use kemalevren\Geth\JsonRpc;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
 */

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('generate:organization', function () {
    DB::table('organizations')->delete();

    $jsonRpc = new JsonRpc();
    $jsonRpc->setOptions([
        'version' => config('api.rpc.version'),
        'host' => config('api.rpc.host'),
        'port' => config('api.rpc.port'),
        'assoc' => config('api.rpc.assoc'),
    ]);

    $wallet = $jsonRpc->personal_newAccount('password');

    DB::table('organizations')->insert([
        'id' => '1',
        'reference_code' => '735DK3D4',
        'wallet' => $wallet,
        'name' => 'Galileo Shelters',
        'email' => 'info@galileogalilei.io',
        'phone_number' => '+39 0101010101',
        'website' => 'https://github.com/orgs/Galileo-VHacks/',
        'type' => 'shelter',
        'lat' => '41.9021193',
        'long' => '12.4587924',
        'created_at' => '2018-03-10 01:33:49',
        'updated_at' => '2018-03-10 01:33:49'
    ]);

    $wallet = $jsonRpc->personal_newAccount('password1');

    DB::table('organizations')->insert([
        'id' => '2',
        'reference_code' => '735DK3D5',
        'wallet' => $wallet,
        'name' => 'Galileo Pantries',
        'email' => 'info@galileogalilei.io',
        'phone_number' => '+39 0101010101',
        'website' => 'https://github.com/orgs/Galileo-VHacks/',
        'type' => 'pantry',
        'lat' => '43.9021193',
        'long' => '11.4587924',
        'created_at' => '2018-03-10 01:33:49',
        'updated_at' => '2018-03-10 01:33:49'
    ]);

})->describe('Setup a new organization');
