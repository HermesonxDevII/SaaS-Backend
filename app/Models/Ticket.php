<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {
    protected $connection = 'pgsql';
    protected $table = 'tickets';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'company_id',
        'solicitation_type_id',
        'description',
        'priority_id',
        'responsible_team_id',
        'attachments',
        'active',
        'deleted'
    ];

    public $timestamps = true;
}
