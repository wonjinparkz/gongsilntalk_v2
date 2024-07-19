<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class InteriorEstimateType extends Model
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'interior_estimate_type';

    protected $fillable = [
        'interior_estimate_id',
        'type',
    ];

    protected $hidden = [];

    protected $casts = [];
}
