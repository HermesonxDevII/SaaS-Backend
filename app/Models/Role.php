<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model {

    use HasFactory;
    
    protected $connection = 'mysql';
    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'active',
        'deleted'
    ];

    public $timestamps = true;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
