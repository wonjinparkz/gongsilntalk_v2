<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class InteriorEstimate extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'interior_estimate';

    protected $fillable = [
        'type',
        'area',
        'users_count',
        'place',
        'move_date',
        'company_name',
        'company_phone',
        'user_name'
    ];

    protected $hidden = [];

    protected $casts = [
        'company_phone' => 'encrypted',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /** 인테리어 타입 */
    public function types()
    {
        return $this->hasMany(InteriorEstimateType::class, 'interior_estimate_id', 'id');
    }
}
