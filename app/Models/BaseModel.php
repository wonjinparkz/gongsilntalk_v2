<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class BaseModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * JSON 으로 만들 때 날짜 형식
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * 날짜 범위 검색
     */
    public function scopeDurationDate($query, $column, $from_date, $to_date)
    {
        return $query
            ->whereDate($column, '>=', date($from_date))
            ->whereDate($column, '<=', date($to_date));
    }


    /**
     * 이미지 가져오기
     */
    public function images()
    {
        return $this->morphMany(Images::class, 'target');
    }
}
