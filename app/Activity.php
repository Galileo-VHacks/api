<?php

namespace Api;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'activities';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'type',
        'user_id',
        'reference_code',
    ];
}
