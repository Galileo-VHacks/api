<?php

return [

    'version' => getenv('RPC_VERSION', '2.0'),
    'host' => getenv('RPC_HOST', '127.0.0.1'),
    'port' => getenv('RPC_PORT', '8545'),
    'assoc' => true,

];