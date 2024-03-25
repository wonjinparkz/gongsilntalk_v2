<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProposalRegion extends BaseModel
{
    use HasFactory, Notifiable;

     /**
     * Table Name
     */
    protected $table = 'proposal_region';


    /**
     * Fillable
     */
    protected $fillable = [
        'proposal_id',
        'region_code',
        'city_name',
        'region_name',
    ];

    /**
     * Hidden
     */
    protected $hidden = [
    ];

    /**
     * Cast
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

}
