<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyGroup extends Model {
    protected $connection = 'pgsql';
    protected $table = 'companies_groups';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'name',
        'active',
        'deleted'
    ];

    public $timestamps = true;
}
