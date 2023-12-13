<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

class Statistik extends Model
{
    use HasFactory;

    protected $fillable = ['periode', 'pengikut', 'jangkauan', 'interaksi', 'sosmed_id', 'evaluasi'];
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

    public function sosmed(): BelongsTo
    {
        return $this->belongsTo(Sosmed::class);
    }
}
