<?php

namespace Api;

use Illuminate\Database\Eloquent\Model;
use Api\User;

class Wallet extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'wallets';

    protected $fillable = [
        'balance',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

}
