<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'Pending';
    public const STATUS_COMPLETED = 'Completed';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    /**
     * The default attribute values.
     *
     * @var array<string, string>
     */
    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];
}
