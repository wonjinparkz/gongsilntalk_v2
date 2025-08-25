@extends('layouts.staging')

@section('title', '회사 소개 - 공실앤톡')

@section('content')
<div class="about-v2-container">
    
    <!-- Hero Section -->
    <x-v2.hero.hero-basic 
        :mainTitle1="'부동산 시장의'"
        :mainTitle2="'새로운 기준을'"
        :mainTitle3="'만들어갑니다'"
        :mainTitle1Bold="['부동산 시장']"
        :mainTitle2Bold="['새로운 기준']"
        :mainTitle3Bold="[]"
        :mainBackgroundImage="'/assets/media/auth/bg2.jpg'"
        :subImage="'/assets/media/auth/bg2.jpg'"
        :subText1="'<strong>공실앤톡은 2015년 설립 이후 꾸준한 성장을 이어가고 있습니다.</strong>'"
        :subText2="'기술과 부동산의 만남으로 새로운 가치를 창출합니다.'"
        :subText3="'고객 중심의 서비스로 신뢰받는 기업이 되겠습니다.'"
    />

    <!-- Company Values -->
    <section class="section-padding">
        <x-v2.text.title-box 
            :subtitle="'공실앤톡의'"
            :subtitleHighlight="['공실앤톡']"
            :title="'핵심 가치'"
            :alignment="'center'"
        />
        
        <x-v2.features.feature-cards 
            :cards="[
                [
                    'subtitle' => '첫 번째 가치',
                    'title' => '혁신<br>Innovation',
                    'description' => '',
                    'image' => '/assets/media/m_bn_img_1.png',
                ],
                [
                    'subtitle' => '두 번째 가치',
                    'title' => '신뢰<br>Trust',
                    'description' => '',
                    'image' => '/assets/media/m_bn_img_1.png',
                ],
                [
                    'subtitle' => '세 번째 가치',
                    'title' => '성장<br>Growth',
                    'description' => '',
                    'image' => '/assets/media/m_bn_img_1.png',
                ],
                [
                    'subtitle' => '네 번째 가치',
                    'title' => '협력<br>Cooperation',
                    'description' => '',
                    'image' => '/assets/media/m_bn_img_1.png',
                ],
                [
                    'subtitle' => '다섯 번째 가치',
                    'title' => '책임<br>Responsibility',
                    'description' => '',
                    'image' => '/assets/media/m_bn_img_1.png',
                ],
            ]"
        />
    </section>

</div>

<style>
.about-v2-container {
    width: 100%;
    position: relative;
}

.section-padding {
    padding: 80px 20px;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .section-padding {
        padding: 60px 16px;
    }
}

@media (max-width: 480px) {
    .section-padding {
        padding: 40px 16px;
    }
}
</style>
@endsection