<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\{ Model, Builder };
use App\Models\{
    User,
    Company,
    Priority,
    ResponsibleTeam,
    SolicitationType
};

class Ticket extends Model {

    use HasFactory;
    
    protected $connection = 'mysql';
    protected $table = 'tickets';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
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

    protected $casts = [
        'active'      => 'boolean',
        'deleted'     => 'boolean',
        'attachments' => 'array'
    ];

    protected $appends = [
        'created_at_extenso'
    ];
    
    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', loggedUser()->id)
                ->where('deleted', '<>', true);
        });
    }
    
    public $timestamps = true;

    public function getCreatedAtExtensoAttribute(): string
    {
        return $this->created_at
            ->locale('pt_BR')
            ->translatedFormat("d \\d\\e F \\d\\e Y \\à\\s H:i");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }

    public function responsibleTeam(): BelongsTo
    {
        return $this->belongsTo(ResponsibleTeam::Class);
    }

    public function solicitationType(): BelongsTo
    {
        return $this->belongsTo(SolicitationType::class);
    }
}
