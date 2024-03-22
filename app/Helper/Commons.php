<?php

namespace App\Helper;

class Commons
{
    public static function get_priceTrans($number)
    {

        $num = array('', '일', '이', '삼', '사', '오', '육', '칠', '팔', '구');
        $unit4 = array('', '만', '억', '조', '경');
        $unit1 = array('', '십', '백', '천');

        $res = array();

        $number = str_replace(',', '', $number);
        $split4 = str_split(strrev((string)$number), 4);

        for ($i = 0; $i < count($split4); $i++) {

            $temp = array();

            $split1 = str_split((string)$split4[$i], 1);

            for ($j = 0; $j < count($split1); $j++) {

                $u = (int)$split1[$j];

                if ($u > 0) $temp[] = $u . $unit1[$j];
            }
            if (count($temp) > 0) $res[] = implode('', array_reverse($temp)) . $unit4[$i];
        }

        return implode('', array_reverse($res)) . "원";
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
