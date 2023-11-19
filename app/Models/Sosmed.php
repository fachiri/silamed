<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Sosmed extends Model
{
    use HasFactory;

    protected $fillable = ['sosmed', 'icon', 'name', 'link'];
    protected $guarded = ['_token'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }

    public function statistiks(): HasMany
    {
        return $this->hasMany(Statistik::class);
    }

    public function targets(): HasMany
    {
        return $this->hasMany(Target::class);
    }
}
