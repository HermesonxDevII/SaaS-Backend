<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\{ HasMany, BelongsTo };
use Illuminate\Database\Eloquent\{ Model, Builder };
use App\Models\{ User, Ticket };

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

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
