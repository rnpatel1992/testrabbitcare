<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;
class ShortUrl extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'expiry_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'origin_url',
        'short_code',
        'expiry_date',
        'total_hits',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
