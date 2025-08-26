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
        'telephone',
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

    protected $casts = [
        'active'  => 'boolean',
        'deleted' => 'boolean'
    ];

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', loggedUser()->id)
                ->where('deleted', '<>', true);
        });
    }

    public $timestamps = true;

    public function getCpfCnpjAttribute($value)
    {
        if ($value) {
            $value = preg_replace('/[^0-9]/', '', $value);

            if (strlen($value) === 11) {
                return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value);
            } 
            
            if (strlen($value) === 14) {
                return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $value);
            }

            return $value;
        }
    }

    public function getPostalCodeAttribute($value)
    {
        if ($value) {
            $value = preg_replace('/[^0-9]/', '', $value);

            if (strlen($value) === 8) {
                return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $value);
            }

            return $value;
        }
    }

    public function getAddressAttribute(): string
    {
        return $this->street
            . ', ' . $this->number
            . ', ' . $this->neighborhood
            . ' - ' . $this->city
            . ', ' . $this->state
            . ' - ' . $this->postal_code;
    }
    
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
