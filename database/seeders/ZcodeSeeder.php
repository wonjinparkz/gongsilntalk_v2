<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Zcode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ZcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $zones = [

            array('11110', '서울특별시 종로구'),
            array('11140', '서울특별시 중구'),
            array('11170', '서울특별시 용산구'),
            array('11200', '서울특별시 성동구'),
            array('11215', '서울특별시 광진구'),
            array('11230', '서울특별시 동대문구'),
            array('11260', '서울특별시 중랑구'),
            array('11290', '서울특별시 성북구'),
            array('11305', '서울특별시 강북구'),
            array('11320', '서울특별시 도봉구'),
            array('11350', '서울특별시 노원구'),
            array('11380', '서울특별시 은평구'),
            array('11410', '서울특별시 서대문구'),
            array('11440', '서울특별시 마포구'),
            array('11470', '서울특별시 양천구'),
            array('11500', '서울특별시 강서구'),
            array('11530', '서울특별시 구로구'),
            array('11545', '서울특별시 금천구'),
            array('11560', '서울특별시 영등포구'),
            array('11590', '서울특별시 동작구'),
            array('11620', '서울특별시 관악구'),
            array('11650', '서울특별시 서초구'),
            array('11680', '서울특별시 강남구'),
            array('11710', '서울특별시 송파구'),
            array('11740', '서울특별시 강동구'),

            array('41110', '경기도 수원시'),
            array('41130', '경기도 성남시'),
            array('41150', '경기도 의정부시'),
            array('41170', '경기도 안양시'),
            array('41190', '경기도 부천시'),
            array('41210', '경기도 광명시'),
            array('41220', '경기도 평택시'),
            array('41250', '경기도 동두천시'),
            array('41270', '경기도 안산시'),
            array('41280', '경기도 고양시'),
            array('41290', '경기도 과천시'),
            array('41310', '경기도 구리시'),
            array('41360', '경기도 남양주시'),
            array('41370', '경기도 오산시'),
            array('41390', '경기도 시흥시'),
            array('41410', '경기도 군포시'),
            array('41430', '경기도 의왕시'),
            array('41450', '경기도 하남시'),
            array('41460', '경기도 용인시'),
            array('41480', '경기도 파주시'),
            array('41500', '경기도 이천시'),
            array('41550', '경기도 안성시'),
            array('41570', '경기도 김포시'),
            array('41590', '경기도 화성시'),
            array('41610', '경기도 광주시'),
            array('41630', '경기도 양주시'),
            array('41650', '경기도 포천시'),
            array('41670', '경기도 여주시'),
            array('41800', '경기도 연천군'),
            array('41820', '경기도 가평군'),
            array('41830', '경기도 양평군'),

        ];

        foreach ($zones as $zone) {
            Zcode::create([
                'region_code' => $zone[0],
                'zone' => $zone[1]
            ]);
        }
    }
}
