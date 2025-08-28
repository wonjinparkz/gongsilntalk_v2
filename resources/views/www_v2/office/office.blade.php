@extends('layouts.staging')

@section('title', '공실앤톡 - 스마트한 부동산 솔루션')

@section('content')
<div class="main-v2-container">

    <!-- Hero Section -->
    <x-v2.features.office-visual 
        :title="'독립형 오피스'"
        :description="'독립형 오피스는 프라이빗한 사무 공간과 함께<br>라운지, 미팅룸, 화장실 등 다양한 공용 공간을 제공합니다.<br>공유오피스의 편리함과 프라이빗한 환경을 한곳에서 경험해 보세요.'"
        :info="[
            ['label' => '추천 인원', 'value' => '1-30인'],
            ['label' => '추천 대상', 'value' => '소규모 팀, 스타트업'],
            ['label' => '최소 계약 기간', 'value' => '1개월'],
        ]"
        :buttonText="'최저가 견적 받기'"
        :buttonLink="'#'"
        :desktopImage="'/assets/media/type3_img_1.png'"
        :mobileImage="'/assets/media/type3_img_1.png'"
        :imageAlt="'독립형 오피스 이미지'"
        :backgroundColor="'#FFFFFF'"
    />
    <section class="section-padding" style="text-align: center;">
        <x-v2.features.info-cards 
            :title="'당신의 비즈니스에 꼭 맞는<br>3가지 오피스 컨설팅'"
            :cards="[
                [
                    'title' => '맞춤형 오피스',
                    'description' => [
                        '예산과 필요에 맞춘',
                        '효율적인 공간 설계',
                        '최적화된 업무 환경 제공'
                    ],
                    'image' => '/assets/media/type3_img_1.png'
                ],
                [
                    'title' => '전층형 오피스',
                    'description' => [
                        '한 층 전용의',
                        '독립형 대규모 사무 공간',
                        '프라이빗한 업무 환경'
                    ],
                    'image' => '/assets/media/type3_img_1.png'
                ],
                [
                    'title' => '프리미엄 오피스',
                    'description' => [
                        '고급 마감재와 디자인으로',
                        '완성한 하이엔드 공간',
                        '브랜드 가치 극대화'
                    ],
                    'image' => '/assets/media/type3_img_1.png'
                ],
                [
                    'title' => '',
                    'description' => [''],
                    'image' => ''
                ]
            ]"
            :footerText="[
                '공실앤톡은 기업 규모•업무 특성•브랜드 이미지에 맞춰 세 가지 오피스 솔루션을 제공합니다.',
                '분양 계약 고객에게는 모든 컨설팅과 시공이 무료로 제공되며, 별도 의뢰 시 전문팀이 유료 서비스로 진행합니다.'
            ]"
        />
                        <!-- Centered Button -->
        <div style="text-align: center;">
            <button class="btn btn-secondary">최저가 견적받기</button>
        </div> 
    </section>


            <!-- Client Logos -->
    <section class="section-padding" style="background:#F1F4F8; padding: 180px 0px;">
        <x-v2.text.title-box 
            :subtitle="''"
            :subtitleHighlight="['']"
            :title="'전국 실시간 현장 한눈에 알아보기'"
            :alignment="'center'"
            :containerClass="'mb-0'"
        />
        <x-v2.features.location-marquee />
        <div style="text-align: center; gap:15px; display:flex; justify-content:center;">
            <button class="btn btn-outline-secondary">특별혜택 현장바로가기</button> <button class="btn btn-secondary">전국 현장 바로가기</button>
        </div>
    </section>


    <section class="section-padding" style="text-align: center;">
    <!-- Product Comparison Section -->
    <x-v2.comparison.product-comparison 
        :title="'상품별 비교'"
        :titleAlign="'center'"
        :contentAlign="'left'"
        :highlightCard="1"
        :cards="[
            [
                'image' => '/assets/media/main_page/f5.png',
                'title' => '맞춤형 오피스',
                'description' => '기업의 규모와 업무 특성에 최적화된 공간 설계. 가구·인테리어·동선을 효율적으로 구성하여 예산 내 최적의 업무 환경을 제공합니다.',
                'specs' => [
                    ['label' => '최소 계약 기간', 'value' => '1개월'],
                    ['label' => '추천 인원', 'value' => '1-20인'],
                    ['label' => '추천 대상', 'value' => '스타트업, 소규모 팀, 지사 사무실'],
                    ['label' => '특징', 'value' => '맞춤형 설계+공용 공간 활용'],
                ],
                'services' => [
                    ['label' => '주요 서비스', 'items' => ['가구•인테리어 세팅', '3D 공간 설계', '공용 회의실•라운지 이용']],
                ],
                'buttonText' => '문의하기',
                'buttonLink' => '#',
            ],
            [
                'image' => '/assets/media/main_page/f5.png',
                'title' => '전층형 오피스',
                'description' => '한 층 전체를 독립적으로 사용하는 전용 오피스. 회의실·휴게공간·창고 등 필요한 모든 공간을 기업 브랜드에 맞춰 통합 설계합니다.',
                'specs' => [
                    ['label' => '최소 계약 기간', 'value' => '1개월'],
                    ['label' => '추천 인원', 'value' => '30-50인'],
                    ['label' => '추천 대상', 'value' => '중견•대기업, 프로젝트 TF, R&D 연구소'],
                    ['label' => '특징', 'value' => '전층 전용 공간 + 독립 출입 동선'],
                ],
                'services' => [
                    ['label' => '주요 서비스', 'items' => ['맞춤형 인테리어', '대형 가구 세팅', '전용 회의실•휴게공간 설치']],
                ],
                'buttonText' => '자세히 보기',
                'buttonLink' => '#',
            ],
            [
                'image' => '/assets/media/main_page/f5.png',
                'title' => '프리미엄 오피스',
                'description' => '고급 마감재와 프리미엄 가구로 완성되는 하이엔드 오피스. 차별화된 디자인으로 기업의 품격과 가치를 높입니다.',
                'specs' => [
                    ['label' => '최소 계약 기간', 'value' => '1개월'],
                    ['label' => '추천 인원', 'value' => '10~30인'],
                    ['label' => '추천 대상', 'value' => 'VIP 고객 응대 기업, 해외 바이어 상담 기업'],
                    ['label' => '특징', 'value' => '프리미엄 자재 사용+고급 가구+맞춤 디자인'],
                ],
                'services' => [
                    ['label' => '주요 서비스', 'items' => ['하이엔드 인테리어', '프리미엄 가구•조명', '독창적 디자인 설계']],
                ],
                'buttonText' => '자세히 보기',
                'buttonLink' => '#',
            ],
        ]"
    />
    </section>

                <!-- Gallery Section2 -->
    <section class="section-padding" style="text-align: center; background:#F6E8D6; padding: 80px 0;">
        <h2 style="margin:0;">평형별 공간 둘러보기</h2>
        
        <!-- Simple Gallery -->
        <x-v2.gallery.tab-gallery 
            :height="'500px'"
            :imageIndex="1"
        />
                <!-- Centered Button -->
        <div style="text-align: center;">
            <button class="btn btn-secondary">무료 공간컨설팅 견적받기</button>
        </div> 
    </section>

    <section class="section-padding-2" style="text-align: center;">

    <div class="cost-saving-title">
        <h3>벌써 많은 기업들은</h3>
        <h3>사무실 비용 아끼는 중</h3>
        <div class="title-divider"></div>
        <p class="subtitle-text">아까운 비용 낭비는 딱 여기까지만 하세요</p>
    </div>

        <!-- Cost Comparison Section -->
        <x-v2.features.cost-comparison 
            :mainTitle="'초기비용 단돈 0원'"
            :titleHighlight="['단돈 0원']"
            :description="[
                '분양 계약 고객에게는',
                '맞춤형 3D공간 설계와',
                '가구 무료 제공'
            ]"
            :badge="[
                'amount' => '1억 8,000만원',
                'label' => 'SAVE'
            ]"
            :leftBox="[
                'title' => '일반 사무실 약',
                'titleHighlight' => ['1.8억원'],
                'bgColor' => '#333333'
            ]"
            :rightBox="[
                'title' => '공실앤톡 0원',
                'titleHighlight' => ['0원'],
                'bgColor' => '#FFD700'
            ]"
            :centerDescription="'보증금 + 인테리어 + 가구 구매 비용<br>(30인 독립형 오피스 기준 - 약 80평)'"
            :backgroundImage="'/assets/media/type3_img_1.png'"
            :imagePosition="'right'"
        />

                <x-v2.features.cost-comparison 
            :mainTitle="'관리 운영비 ALL FREE'"
            :titleHighlight="['ALL FREE']"
            :description="[
                '가구 구매와 배치가 번거로우신가요?',
                '전문 컨설팅을 통한 맞춤형 가구 선정과',
                '완벽한 사무 공간 세팅을 무료 제공합니다.'
            ]"
            :badge="[
                'amount' => '100만원',
                'label' => 'SAVE'
            ]"
            :leftBox="[
                'title' => '직원 1인당 가구비',
                'titleHighlight' => ['100만원'],
                'bgColor' => '#333333'
            ]"
            :rightBox="[
                'title' => '공실앤톡 0원',
                'titleHighlight' => ['0원'],
                'bgColor' => '#FFD700'
            ]"
            :centerDescription="'직원 1인당 평균 사무용 가구 비용<br>(책상, 의자, 수납장 등 기본 세팅)'"
            :backgroundImage="'/assets/media/type3_img_1.png'"
            :imagePosition="'left'"
        />

                <x-v2.features.cost-comparison 
            :mainTitle="'홍보•마케팅 비용 무료!'"
            :titleHighlight="['비용 무료!']"
            :description="[
                '공실 매물 홍보를 위해 메타포트 VR/3D 촬영과',
                '고급 사진 촬영을 무료 진행하여',
                '별도 촬용 비용(수백만원)을 절감할 수 있습니다.'
            ]"
            :badge="[
                'amount' => '500만원',
                'label' => 'SAVE'
            ]"
            :leftBox="[
                'title' => '일반 홍보비용 약 500만원',
                'titleHighlight' => ['500만원'],
                'bgColor' => '#333333'
            ]"
            :rightBox="[
                'title' => '공실앤톡 0원',
                'titleHighlight' => ['0원'],
                'bgColor' => '#FFD700'
            ]"
            :centerDescription="'VR촬영 + 전문사진 촬영 비용<br>(평균 홍보•마케팅 비용)'"
            :backgroundImage="'/assets/media/type3_img_1.png'"
            :imagePosition="'right'"
        />

                <x-v2.features.cost-comparison 
            :mainTitle="'분석 리포트 무료 제공'"
            :titleHighlight="['무료 제공']"
            :description="[
                '공실 광고 대행과 현 임대료 시세 분석 리포트',
                '무료 제공으로 평균 공실 기간을 단축하고,',
                '관리비•세금 부담을 줄여드립니다.'
            ]"
            :badge="[
                'amount' => '200만원',
                'label' => 'SAVE'
            ]"
            :leftBox="[
                'title' => '일반 분석비용 약 200만원',
                'titleHighlight' => ['200만원'],
                'bgColor' => '#333333'
            ]"
            :rightBox="[
                'title' => '공실앤톡 0원',
                'titleHighlight' => ['0원'],
                'bgColor' => '#FFD700'
            ]"
            :centerDescription="'임대료 시세 분석 + 리포트 제작<br>(전문 컨설팅 비용)'"
            :backgroundImage="'/assets/media/type3_img_1.png'"
            :imagePosition="'left'"
        />

                <x-v2.features.cost-comparison 
            :mainTitle="'전담 케어 무료 지원'"
            :titleHighlight="['전담 케어 무료']"
            :description="[
                '계약부터 입주까지 전 과정 무료지원',
                '대형 호실의 경우',
                '입주관리•정기 청소 서비스 연계'
            ]"
            :badge="[
                'amount' => '100만원',
                'label' => 'SAVE'
            ]"
            :leftBox="[
                'title' => '일반 관리비용 약 100만원',
                'titleHighlight' => ['100만원'],
                'bgColor' => '#333333'
            ]"
            :rightBox="[
                'title' => '공실앤톡 0원',
                'titleHighlight' => ['0원'],
                'bgColor' => '#FFD700'
            ]"
            :centerDescription="'입주 관리 + 정기 청소 서비스<br>(월 평균 관리 서비스 비용)'"
            :backgroundImage="'/assets/media/type3_img_1.png'"
            :imagePosition="'right'"
        />

                <x-v2.features.features-basic 
            :subtitle="'상담 신청부터<br>입주까지 단 하루!'"
            :title="'당일 입주 가능'"
            :description="'공실앤톡은 계약 즉시 바로 쓸 수 있습니다.'"
            :imagePosition="'right'"
            :textAlign="'center'"
            :image="'/assets/media/main_page/in_process.png'"
        />
    </section>

</div>

<style>
.main-v2-container {
    width: 100%;
    position: relative;
}

.section-padding {
  padding: 180px 50px;
  gap: 60px;
  display: flex;
  flex-direction: column;
}

.section-padding-2 {
  padding: 180px 50px;
  gap: 130px;
  display: flex;
  flex-direction: column;
}

.bg-gray {
    background-color: #FAFAFA;
}

.mb-0 {
    margin-bottom: 0 !important;
}


.cost-saving-title h3 {
    font-size: 42px;
    font-weight: 700;
    color: #222;
    margin: 0;
    line-height: 1.2;
}

.title-divider {
    width: 80px;
    height: 4px;
    background-color: #F16341;
    margin: 24px auto;
    border-radius: 2px;
}

.subtitle-text {
    font-size: 16px;
    font-weight: 400;
    color: #666;
    margin: 16px 0 0 0;
    line-height: 1.5;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .section-padding {
        padding: 60px 16px;
        gap: 40px;
    }
    
    .cost-saving-title h3 {
        font-size: 32px;
    }
    
    .subtitle-text {
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .section-padding {
        padding: 40px 16px;
    }

    .section-padding-2 {
        gap: 60px;
    }
    
    .cost-saving-title h3 {
        font-size: 28px;
    }
    
    .cost-saving-title {
        margin-bottom: 40px;
    }
}
</style>
@endsection