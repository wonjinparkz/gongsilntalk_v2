<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transactions extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'transactions_apt';

    /**
     * Fillable
     */
    protected $fillable = [
        'type',
        'transactionPrice',
        'constructionYear',
        'year',
        'roadName',
        'roadBuildingMainCode',
        'roadBuildingSubCode',
        'roadCityCode',
        'roadSerialCode',
        'roadUpDownCode',
        'roadCode',
        'legalDong',
        'legalDongMainNumberCode',
        'legalDongSubNumberCode',
        'legalDongCityCode',
        'legalDongDistrictCode',
        'legalDongCode',
        'aptName',
        'month',
        'day',
        'serialNumber',
        'exclusiveArea',
        'jibun',
        'regionCode',
        'floor',
        'unique_code',

        // 월세에서만 사용
        'transactionMonthPrice',
        'renewalRight',
        'contract_type',
        'contract_at',
        'previousTransactionPrice',
        'previousTransactionMonthPrice',
        'is_matching',
    ];


    /**
     * Hidden
     */
    protected $hidden = [];

    /**
     * Cast
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
