<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TransactionsRegionUpdate extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'transactions_region_update';

    /**
     * Fillable
     */
    protected $fillable = [
        'type',
        'lawd_cd',
        'leagal_code',
        'region_name',
        'last_updated_at',
    ];

    /**
     * Cast
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
