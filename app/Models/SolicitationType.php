<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitationType extends Model {
    protected $connection = 'pgsql';
    protected $table = 'solicitation_types';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'name',
        'active',
        'deleted'
    ];

    public $timestamps = true;
}
