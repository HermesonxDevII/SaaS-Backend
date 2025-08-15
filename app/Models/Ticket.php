<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
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

    public $timestamps = true;

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
