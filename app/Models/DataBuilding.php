<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DataBuilding extends Model
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'data_building';


    /**
     * Fillable
     */
    protected $fillable = [
        // 상가 정보
        'as1',
        'as2',
        'as3',
        'as4',
        'bjdCode',
        'kbuildingName',


        // 상가 기본 정보
        'kbuildingAddr',
        'codeSaleNm',
        'codeHeatNm',
        'kbuildingTarea',
        'kbuildingDongCnt',
        'kbuildingdaCnt',
        'kbuildingBcompany',
        'kbuildingAcompany',
        'kbuildingTel',
        'kbuildingFax',
        'kbuildingUrl',
        'codeAptNm',
        'doroJuso',
        'hoCnt',
        'codeMgrNm',
        'codeHallNm',
        'kbuildingUsedate',
        'kbuildingMarea',
        'kbuildingMparea_60',
        'kbuildingMparea_85',
        'kbuildingMparea_135',
        'kbuildingMparea_136',
        'privArea',


        // 상가 상세 정보
        'codeMgr',
        'kbuildingMgrCnt',
        'kbuildingCcompany',
        'codeSec',
        'kbuildingdScnt',
        'kbuildingdSecCom',
        'codeClean',
        'kbuildingdClcnt',
        'codeGarbage',
        'codeDisinf',
        'kbuildingdDcnt',
        'disposalType',
        'codeStr',
        'kbuildingdEcapa',
        'codeEcon',
        'codeEmgr',
        'codeFalarm',
        'codeWsupply',
        'codeElev',
        'kbuildingdEcnt',
        'kbuildingdPcnt',
        'kbuildingdPcntu',
        'codeNet',
        'kbuildingdCccnt',
        'welfareFacility',
        'kbuildingdWtimebus',
        'subwayLine',
        'subwayStation',
        'kbuildingdWtimesub',
        'convenientFacility',
        'educationFacility',

        // 지도 정보
        'x',
        'y',

        // 유사 단지명
        'complex_name',

        //토지 정보
        'pnu',
        'polygon_coordinates',
        'characteristics_json',
        'useWFS_json',

        //비공개
        'is_blind',
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

    /**
     * 표지부 데이터
     */
    public function BrTitleInfo()
    {
        return $this->morphOne(BrTitleInfo::class, 'target');
    }

    /**
     * 표지부 데이터
     */
    public function BrRecapTitleInfo()
    {
        return $this->morphOne(BrRecapTitleInfo::class, 'target');
    }

    /**
     * 표지부 데이터
     */
    public function BrFlrOulnInfo()
    {
        return $this->morphOne(BrFlrOulnInfo::class, 'target');
    }

    /**
     * 표지부 데이터
     */
    public function BrExposInfo()
    {
        return $this->morphOne(BrExposInfo::class, 'target');
    }

    /**
     * 표지부 데이터
     */
    public function BrExposPubuseAreaInfo()
    {
        return $this->morphOne(BrExposPubuseAreaInfo::class, 'target');
    }
}
