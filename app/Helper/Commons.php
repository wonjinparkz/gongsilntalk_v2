<?php

namespace App\Helper;

class Commons
{
    public static function get_priceTrans($number)
    {

        $unit = array("조", "억", "만", "천");
        $divisor = array(1000000000000, 100000000, 10000, 1000);

        $converted = '';
        for ($i = 0; $i < count($unit); $i++) {
            $quotient = floor($number / $divisor[$i]);
            if ($quotient > 0) {
                $converted .= $quotient . $unit[$i] . ' ';
                $number %= $divisor[$i];
            }
        }

        return trim($converted) . '원';
    }

    public static function get_moveType($moveType, $startDate, $endDate)
    {
        $move = '';

        switch ($moveType) {
            case '0':
                $move = '즉시입주';
                break;
            case '1':
                $move = '날짜 협의';
                break;
            case '2':
                $move = $startDate ?? '-' . ' ~ ' . $endDate ?? '-';
                break;
            default:
                $move = '-';
                break;
        }
        return $move;
    }

    public static function get_interiorType($interiorType)
    {
        $interior = '';

        switch ($interiorType) {
            case '0':
                $interior = '선택 안함';
                break;
            case '1':
                $interior = '필요해요';
                break;
            case '2':
                $interior = '필요 없어요';
                break;
            default:
                $interior = '-';
                break;
        }
        return $interior;
    }

    public static function get_floorType($floorType)
    {
        $floor = '';

        switch ($floorType) {
            case '0':
                $floor = '상관없음';
                break;
            case '1':
                $floor = '1층';
                break;
            case '2':
                $floor = '2층 이상';
                break;
            default:
                $floor = '-';
                break;
        }
        return $floor;
    }
}
