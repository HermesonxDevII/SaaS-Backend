<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\{
    Company,
    CompanyGroup, 
    CompanySegment,
    Priority,
    ResponsibleTeam,
    Role,
    SolicitationType,
    Ticket
};

class User extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'pgsql';
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'active',
        'deleted'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function companiesGroupies(): HasMany
    {
        return $this->hasMany(CompanyGroup::class);
    }

    public function companies_segments(): HasMany
    {
        return $this->hasMany(CompanySegment::class);
    }

    public function priorities(): HasMany
    {
        return $this->hasMany(Priority::class);
    }

    public function responsibleTeams(): HasMany
    {
        return $this->hasMany(ResponsibleTeam::class);
    }

    public function solicitationTypes(): HasMany
    {
        return $this->hasMany(SolicitationType::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
