<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{ HasMany, BelongsTo };
use Illuminate\Database\Eloquent\Model;
use App\Models\{ User, Company };

class CompanyGroup extends Model {

    use HasFactory;
    
    protected $connection = 'mysql';
    protected $table = 'companies_groups';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'name',
        'active',
        'deleted'
    ];

    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
