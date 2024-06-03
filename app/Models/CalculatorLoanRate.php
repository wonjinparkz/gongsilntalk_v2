<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CalculatorLoanRate extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'calculator_loan_rate';

    /**
     * 모델
     */
    protected $fillable = [
        'calculator_loan_id',
        'sequence',
        'interest_rate'
    ];

    /**
     * 직렬화에서 감출것
     */
    protected $hidden = [];

    /**
     * 캐스팅
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
