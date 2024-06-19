<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Token extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes;

    public $table = 'tokens';

    public static $search = [
        'private_key',
        'uxwallet',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $orderable = [
        'id',
        'private_key',
        'uxwallet',
        'aff',
        'status',
    ];

    public $filterable = [
        'id',
        'private_key',
        'uxwallet',
        'aff',
        'status',
    ];

    protected $fillable = [
        'private_key',
        'uxwallet',
        'token',
        'aff',
        'status',
    ];

    public const STATUS_RADIO = [
        'pending'   => 'pending',
        'working'   => 'working',
        'bad'       => 'bad',
        'connected' => 'connected',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_RADIO[$this->status] ?? null;
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getDeletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }
}
