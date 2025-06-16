<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model {
    protected $connection = 'pgsql';
    protected $table = 'priorities';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'name',
        'active',
        'deleted'
    ];

    public $timestamps = true;
}
