<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use DateTimeInterface;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Twitter extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes;

    public $table = 'twitters';

    protected $hidden = [
        // 'password',
    ];

    public static $search = [
        'username',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'username',
        'password',
        'status',
        'user_id',
        'token_id',
    ];

    public $orderable = [
        'id',
        'username',
        'status',
        'token.private_key',
    ];

    public $filterable = [
        'id',
        'username',
        'status',
        'token.private_key',
    ];

    public const STATUS_RADIO = [
        'pending'   => 'pending',
        'good'      => 'Good',
        'connected' => 'connected',
        'other'     => 'other',
        'bad'       => 'Bad',
        'working'   => 'working',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // public function setPasswordAttribute($input)
    // {
    //     if ($input) {
    //         $this->attributes['password'] = Hash::needsRehash($input) ? Hash::make($input) : $input;
    //     }
    // }

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_RADIO[$this->status] ?? null;
    }

    public function token()
    {
        return $this->belongsTo(Token::class);
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
