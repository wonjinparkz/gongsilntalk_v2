<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class DataApt extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'data_apt';


    /**
     * Fillable
     */
    protected $fillable = [
        // 아파트 정보
        'as1',
        'as2',
        'as3',
        'as4',
        'bjdCode',
        'kaptCode',
        'kaptName',


        // 아파트 기본 정보
        'is_base_info',
        'kaptAddr',
        'codeSaleNm',
        'codeHeatNm',
        'kaptTarea',
        'kaptDongCnt',
        'kaptdaCnt',
        'kaptBcompany',
        'kaptAcompany',
        'kaptTel',
        'kaptFax',
        'kaptUrl',
        'codeAptNm',
        'doroJuso',
        'hoCnt',
        'codeMgrNm',
        'codeHallNm',
        'kaptUsedate',
        'kaptMarea',
        'kaptMparea_60',
        'kaptMparea_85',
        'kaptMparea_135',
        'kaptMparea_136',
        'privArea',


        // 아파트 상세 정보
        'is_detail_info',
        'codeMgr',
        'kaptMgrCnt',
        'kaptCcompany',
        'codeSec',
        'kaptdScnt',
        'kaptdSecCom',
        'codeClean',
        'kaptdClcnt',
        'codeGarbage',
        'codeDisinf',
        'kaptdDcnt',
        'disposalType',
        'codeStr',
        'kaptdEcapa',
        'codeEcon',
        'codeEmgr',
        'codeFalarm',
        'codeWsupply',
        'codeElev',
        'kaptdEcnt',
        'kaptdPcnt',
        'kaptdPcntu',
        'codeNet',
        'kaptdCccnt',
        'welfareFacility',
        'kaptdWtimebus',
        'subwayLine',
        'subwayStation',
        'kaptdWtimesub',
        'convenientFacility',
        'educationFacility',

        // 지도 정보
        'is_map_info',
        'x',
        'y',

        // 유사 단지명
        'complex_name',
        'pnu',
        'polygon_coordinates',
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

    public function transactions()
    {
        return Transactions::where('legalDongCityCode', substr($this->bjdCode, 0, 5))
            ->where('is_matching', '1')
            ->where('type', '0')
            ->where('legalDong', $this->as3)
            ->where(function ($query) {
                $query->where('transactions_apt.aptName', $this->kaptName)
                    ->orWhere(function ($subQuery) {
                        $subQuery->whereRaw('FIND_IN_SET(transactions_apt.aptName, ?)', [$this->complex_name]);
                    });
            });
    }

    public function transactionsRent()
    {
        return Transactions::where('legalDongCityCode', substr($this->bjdCode, 0, 5))
            ->where('is_matching', '1')
            ->where('type', '1')
            ->where('legalDong', $this->as3)
            ->where(function ($query) {
                $query->where('transactions_apt.aptName', $this->kaptName)
                    ->orWhere(function ($subQuery) {
                        $subQuery->whereRaw('FIND_IN_SET(transactions_apt.aptName, ?)', [$this->complex_name]);
                    });
            });
    }

    /**
     * 표제부 데이터
     */
    public function BrTitleInfo()
    {
        return $this->morphMany(BrTitleInfo::class, 'target');
    }

    /**
     * 표제부 데이터
     */
    public function BrRecapTitleInfo()
    {
        return $this->morphMany(BrRecapTitleInfo::class, 'target');
    }

    /**
     * 표제부 데이터
     */
    public function BrFlrOulnInfo()
    {
        return $this->morphMany(BrFlrOulnInfo::class, 'target');
    }

    /**
     * 표제부 데이터
     */
    public function BrExposInfo()
    {
        return $this->morphMany(BrExposInfo::class, 'target');
    }

    /**
     * 표제부 데이터
     */
    public function BrExposPubuseAreaInfo()
    {
        return $this->morphMany(BrExposPubuseAreaInfo::class, 'target');
    }
}
