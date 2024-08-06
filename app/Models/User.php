<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends BaseModel
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'provider',
        'email',
        'password',
        'token',
        'type',
        'state',
        'contract_cancell_at',
        'name',
        'nickname',
        'phone',
        'gender',
        'birth',
        'unique_key',
        'leave_reason',
        'leaved_at',
        'device_type',
        'fcm_key',
        'is_alarm',
        'is_marketing',
        'marketing_at',
        'company_state',
        'company_name',
        'company_phone',
        'company_ceo',
        'company_number',
        'company_postcode',
        'company_address',
        'company_address_lat',
        'company_address_lng',
        'company_address_detail',
        'refuse_coment',
        'refuse_at',
        'brokerage_number',
        'opening_date',
        'remember_token',
        'memo',
        'last_used_at',
    ];

    protected $hidden = [
        'password',
        'device_type',
        'fcm_key',
        'unique_key',
    ];

    protected $casts = [
        'phone' => 'encrypted',
        'company_phone' => 'encrypted',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * 이미지 가져오기
     */
    public function image()
    {
        return $this->morphOne(Images::class, 'target');
    }

    /**
     * 사업자 등록증 가져오기
     */
    public function companyImages()
    {
        $images = $this->hasOne(Images::class, 'target_id', 'id');
        $images->where('target_type', 'company');
        return $images;
    }

    /**
     * 이미지 가져오기
     */
    public function businessImages()
    {
        $images = $this->hasOne(Images::class, 'target_id', 'id');
        $images->where('target_type', 'business');
        return $images;
    }

    /**
     * 사용자 팔로우
     */
    public function user_follow()
    {
        return $this->hasMany(UsersFollows::class, 'users_id', 'id')->with('following')->whereHas('following', function ($query) {
            $query->where('state', 0);
        });
    }

    /**
     * 사용자 팔료잉
     */
    public function user_following()
    {
        return $this->hasMany(UsersFollows::class, 'follow_id', 'id')->with('following')->whereHas('following', function ($query) {
            $query->where('state', 0);
        });
    }

    /**
     * 사용자 차단
     */
    public function block()
    {
        return $this->hasOne(UsersBlocks::class, 'block_id', 'id');
    }

    // 생성일 포멧
    public function getCreatedAtAttribute($date)
    {
        // API 에서는 format('Y-m-d H:i:s') 형식
        $is_api = request()->is('api/*') || request()->is('admin/*') || request()->wantsJson();
        if ($is_api) {
            return Carbon::parse($date)->format('Y-m-d H:i:s');
        }

        //    1일 이내 (당일) : 등록된 시.분 노출
        //    24시간 이후~작성년도의 12월 31일까지 : 등록된 월.일 까지 노출
        //    작성년도의 12월 31일 이후 ~ : 등록된 년.월.일 까지 노출
        $createdAtDay = Carbon::parse($date);
        $nowDay = Carbon::now();
        // $this->pullup_at > $date;
        info($this->pullup_at);
        if ($this->pullup_at > $date) {
            if ($this->pullup_at->isSameDay($nowDay)) {
                return $this->pullup_at->format('H:i');
            } elseif ($nowDay->year == $this->pullup_at->year) {
                return $this->pullup_at->format('m.d');
            } else {
                return $this->pullup_at->format('Y년 m월 d일');
            }
        } else {
            if ($createdAtDay->isSameDay($nowDay)) {
                return Carbon::parse($date)->format('H:i');
            } elseif ($nowDay->year == $createdAtDay->year) {
                return Carbon::parse($date)->format('m.d');
            } else {
                return Carbon::parse($date)->format('Y년 m월 d일');
            }
        }
    }

    /**
     * 매물 목록 가져오기
     */
    public function product()
    {
        return $this->hasMany(Product::class, 'users_id', 'id')->with('priceInfo', 'images');
    }
}
