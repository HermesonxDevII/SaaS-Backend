<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
    protected $connection = 'pgsql';
    protected $table = 'companies';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'corporate_reason',
        'fantasy_name',
        'cpf_cnpj',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
        'postal_code',
        'company_segment_id',
        'company_group_id',
        'latitude',
        'longitude',
        'active',
        'deleted'
    ];

    public $timestamps = true;
}
