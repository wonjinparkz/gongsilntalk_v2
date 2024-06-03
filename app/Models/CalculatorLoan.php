<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CalculatorLoan extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'calculator_loan';

    /**
     * 모델
     */
    protected $fillable = [
        'users_id',
        'type',
        'loan_price',
        'loan_rate',
        'loan_month',
        'holding_month'
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


    /**
     * 중도 상환
     */
    public function prepayments()
    {
        return $this->hasMany(CalculatorLoanPayment::class, 'calculator_loan_id', 'id');
    }

    /**
     * 변동 금리
     */
    public function loan_rates()
    {
        return $this->hasMany(CalculatorLoanRate::class, 'calculator_loan_id', 'id');
    }
}
