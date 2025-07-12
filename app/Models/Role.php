<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model {

    protected $connection = 'pgsql';
    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'user_id',
        'active',
        'deleted'
    ];

    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
