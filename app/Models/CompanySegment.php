<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySegment extends Model {
    protected $connection = 'pgsql';
    protected $table = 'companies_segments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'name',
        'active',
        'deleted'
    ];

    public $timestamps = true;
}
