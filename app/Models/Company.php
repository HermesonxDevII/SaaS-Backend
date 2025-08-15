<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{ HasMany, BelongsTo };
use Illuminate\Database\Eloquent\{ Model, Builder };
use App\Models\{
    User,
    CompanyGroup,
    CompanySegment,
    Ticket
};

class Company extends Model {

    use HasFactory;
    
    protected $connection = 'mysql';
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

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', loggedUser()->id);
        });
    }

    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function companyGroup(): BelongsTo
    {
        return $this->belongsTo(CompanyGroup::Class);
    }

    public function companySegment(): BelongsTo
    {
        return $this->belongsTo(CompanySegment::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
