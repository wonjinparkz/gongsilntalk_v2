<?php

namespace App\Helper;

class Commons
{
    public static function get_priceTrans($price)
    {
        if ($price < 0 || empty($price)) {
            $price = 0;
        }

        $priceUnit = ['', '만', '억', '조', '경'];
        $expUnit = 10000;
        $resultArray = [];
        $result = '';

        foreach ($priceUnit as $k => $v) {
            $unitResult = ($price % pow($expUnit, $k + 1)) / pow($expUnit, $k);
            $unitResult = floor($unitResult);

            if ($unitResult > 0) {
                $resultArray[$k] = $unitResult;
            }
        }

        if (count($resultArray) > 0) {
            foreach ($resultArray as $k => $v) {
                $result = number_format($v) . $priceUnit[$k] . $result;
            }
        }

        return $result . '원';
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

    public static function get_magazineTypeTitle($type)
    {
        $title = '매거진';
        switch ($type) {
            case '0':
                $title = '공톡 유튜브';
                break;
            case '1':
                $title = '공톡 매거진';
                break;
            case '2':
                $title = '공톡 뉴스';
                break;

            default:
                $title = '-';
                break;
        }
        return $title;
    }

    public static function get_communityTypeTitle($category)
    {
        $title = '';
        switch ($category) {
            case '0':
                $title = '자유글';
                break;
            case '1':
                $title = '질문/답변';
                break;
            case '2':
                $title = '후기';
                break;
            case '3':
                $title = '노하우';
                break;

            default:
                $title = '-';
                break;
        }
        return $title;
    }

    public static function get_searchTitle($searchInput, $title)
    {
        $positions = array();
        $offset = 0;

        // $searchInput이 $title에서 등장하는 모든 인덱스를 찾기
        while (($pos = mb_stripos($title, $searchInput, $offset)) !== false) {
            $positions[] = $pos;
            $offset = $pos + mb_strlen($searchInput);
        }

        // 발생 위치를 기준으로 강조된 HTML 생성
        $highlightedTitle = '';
        $lastPos = 0;
        foreach ($positions as $pos) {
            $highlightedTitle .= mb_substr($title, $lastPos, $pos - $lastPos) . '<span class="txt_point">' . mb_substr($title, $pos, mb_strlen($searchInput)) . '</span>';
            $lastPos = $pos + mb_strlen($searchInput);
        }
        $highlightedTitle .= mb_substr($title, $lastPos);

        // 결과를 출력
        return $highlightedTitle;
    }
    public static function get_searchContent($searchInput, $content)
    {
        $positions = array();
        $offset = 0;

        // $searchInput이 $content에서 등장하는 모든 인덱스를 찾기
        while (($pos = mb_stripos($content, $searchInput, $offset)) !== false) {
            $positions[] = $pos;
            $offset = $pos + mb_strlen($searchInput);
        }

        // 발생 위치를 기준으로 강조된 HTML 생성
        $highlightedContent = '';
        $lastPos = 0;
        foreach ($positions as $pos) {
            $highlightedContent .= mb_substr($content, $lastPos, $pos - $lastPos) . '<span class="txt_point">' . mb_substr($content, $pos, mb_strlen($searchInput)) . '</span>';
            $lastPos = $pos + mb_strlen($searchInput);
        }
        $highlightedContent .= mb_substr($content, $lastPos);

        // 결과 반환
        return $highlightedContent;
    }

    public static function getformatPrice($price)
    {
        if ($price !== '') {
            $isNegative = $price < 0;
            $price = abs((int) $price);
            $eok = floor($price / 10000);
            $man = $price % 10000;

            $formattedPrice = '';
            if ($eok > 0 && $man == 0) {
                $formattedPrice = $eok . '억';
            } elseif ($eok > 0) {
                $formattedPrice = $eok . '억 ' . number_format($man) . '만';
            } else {
                $formattedPrice = number_format($man) . '만';
            }

            // 음수이면 '-' 기호를 붙이지 않고 반환
            return $formattedPrice;
        } else {
            return '';
        }
    }
}
