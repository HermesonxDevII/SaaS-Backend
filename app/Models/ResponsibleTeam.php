<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponsibleTeam extends Model {
    protected $connection = 'pgsql';
    protected $table = 'responsible_teams';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'name',
        'active',
        'deleted'
    ];

    public $timestamps = true;
}
