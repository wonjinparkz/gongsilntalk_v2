@props([
    'mainTitle1' => "국내 오피스 '1위'",
    'mainTitle2' => '패스트파이브 공간을',
    'mainTitle3' => '확인해 보세요',
    'mainTitle1Bold' => ["'1위'"], // 굵게 표시할 텍스트 배열
    'mainTitle2Bold' => ['패스트파이브'],
    'mainTitle3Bold' => [],
    'mainBackgroundImage' => '/assets/media/auth/bg2.jpg',
    'subImage' => '/assets/media/auth/bg2.jpg',
    'subImageAlt' => '공실앤톡 서비스',
    'subText1' => '<span class="fw-700">공실앤톡은 부동산 중개업무의 디지털 혁신을 선도합니다.</span>',
    'subText2' => '매물 관리부터 고객 상담까지 모든 과정을 효율적으로 관리하세요.<br>실시간 시장 데이터를 기반으로 정확한 분석을 제공합니다.',
    'subText3' => '전문가의 노하우를 시스템화하여 누구나 쉽게 활용할 수 있습니다.',
    'subText4' => '모바일과 PC에서 언제 어디서나 업무를 처리할 수 있습니다.',
    'subText5' => '고객과의 소통을 원활하게 만드는 다양한 도구를 제공합니다.',
    'subText6' => '',
    'subText7' => '',
    'subText8' => '',
    'subText9' => '',
    'subText10' => '',
    'containerClass' => '',
    'id' => 'hero-' . uniqid()
])

<div class="hero-basic-container {{ $containerClass }}" id="{{ $id }}">
    <!-- Main Hero -->
    <div class="hero-main" style="background-image: url('{{ $mainBackgroundImage }}');">
        <div class="hero-main-gradient-bottom"></div>
        <div class="hero-content-wrapper">
            <div class="hero-main-content">
                <h1 class="hero-main-title">
                    <span class="hero-title-line">
                        @php
                            $text1 = $mainTitle1;
                            foreach($mainTitle1Bold as $boldText) {
                                $text1 = str_replace($boldText, '<strong>' . $boldText . '</strong>', $text1);
                            }
                        @endphp
                        {!! $text1 !!}
                    </span>
                    <span class="hero-title-line">
                        @php
                            $text2 = $mainTitle2;
                            foreach($mainTitle2Bold as $boldText) {
                                $text2 = str_replace($boldText, '<strong>' . $boldText . '</strong>', $text2);
                            }
                        @endphp
                        {!! $text2 !!}
                    </span>
                    <span class="hero-title-line">
                        @php
                            $text3 = $mainTitle3;
                            foreach($mainTitle3Bold as $boldText) {
                                $text3 = str_replace($boldText, '<strong>' . $boldText . '</strong>', $text3);
                            }
                        @endphp
                        {!! $text3 !!}
                    </span>
                </h1>
            </div>
        </div>
    </div>
    
    <!-- Sub Hero -->
    <div class="hero-sub">
        <div class="hero-sub-content">
            <div class="hero-sub-image">
                <img src="{{ $subImage }}" alt="{{ $subImageAlt }}">
                <div class="hero-sub-image-gradient"></div>
                <div class="hero-sub-image-gradient-top"></div>
            </div>
            <div class="hero-sub-text-section">
                <div class="hero-sub-text-wrapper">
                    <div class="hero-sub-text">
                        @if($subText1)<p class="body-t-lg">{!! $subText1 !!}</p>@endif
                        @if($subText2)<p class="body-t-lg">{!! $subText2 !!}</p>@endif
                        @if($subText3)<p class="body-t-lg">{!! $subText3 !!}</p>@endif
                        @if($subText4)<p class="body-t-lg">{!! $subText4 !!}</p>@endif
                        @if($subText5)<p class="body-t-lg">{!! $subText5 !!}</p>@endif
                        @if($subText6)<p class="body-t-lg">{!! $subText6 !!}</p>@endif
                        @if($subText7)<p class="body-t-lg">{!! $subText7 !!}</p>@endif
                        @if($subText8)<p class="body-t-lg">{!! $subText8 !!}</p>@endif
                        @if($subText9)<p class="body-t-lg">{!! $subText9 !!}</p>@endif
                        @if($subText10)<p class="body-t-lg">{!! $subText10 !!}</p>@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hero-basic-container {
    width: 100%;
}

/* Main Hero */
.hero-main {
    position: relative;
    width: 100%;
    height: 735px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow: hidden;
}

.hero-main-gradient-bottom {
    display: none;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100px;
    background: linear-gradient(180deg, rgba(248, 245, 242, 0) 0%, #F8F5F2 100%);
    z-index: 2;
}

.hero-content-wrapper {
    position: relative;
    max-width: 1080px;
    margin: 0 auto;
    padding: 0 20px;
    height: 100%;
    z-index: 2;
}

.hero-main-content {
    display: flex;
    align-items: center;
    height: 100%;
}

.hero-main-title {
    color: white;
    text-align: left;
}

.hero-title-line {
    display: block;
    font-size: 52px !important;
    font-weight: 400 !important;
    line-height: 1.4;
    color:#222;
}

.hero-title-line strong {
    font-weight: 700 !important;
}

/* Sub Hero */
.hero-sub {
    width: 100%;
    height: 735px;
    overflow: hidden;
}

.hero-sub-content {
    display: flex;
    height: 100%;
    position: relative;
}

.hero-sub-image {
    position: absolute;
    left: 0;
    top: 0;
    width: 50%;
    height: 100%;
}

.hero-sub-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-sub-image-gradient {
    position: absolute;
    top: 0;
    right: 0;
    width: 150px;
    height: 100%;
    background: linear-gradient(90deg, rgba(248, 245, 242, 0) 0%, #F8F5F2 100%);
    z-index: 1;
}

.hero-sub-image-gradient-top {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100px;
    background: linear-gradient(180deg, #F8F5F2 0%, rgba(248, 245, 242, 0) 100%);
    z-index: 2;
}

.hero-sub-text-section {
    position: absolute;
    right: 0;
    top: 0;
    width: 50%;
    height: 100%;
    background: #F8F5F2;
    display: flex;
    align-items: center;
}

.hero-sub-text-wrapper {
    max-width: 540px;
    padding: 60px;
}

.hero-sub-text {
    width: 100%;
}

.hero-sub-text .body-t-lg {
    margin-bottom: 16px;
    line-height: 1.6;
    color: #222;
}

.hero-sub-text .body-t-lg:last-child {
    margin-bottom: 0;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .hero-main {
        height: 520px;
    }
    
    .hero-main-content {
        align-items: flex-start;
        padding-top: 60px;
    }
    
    .hero-main-gradient-bottom {
        display: block;
    }
    
    .hero-title-line {
        font-size: 36px !important;
        font-weight: 400 !important;
        margin-bottom: 4px;
    }
    
    .hero-sub {
        height: auto;
        min-height: 520px;
    }
    
    .hero-sub-content {
        flex-direction: column;
        position: relative;
    }
    
    .hero-sub-image {
        position: relative;
        width: 100%;
        height: 300px;
        order: 2;
    }
    
    .hero-sub-image-gradient {
        display: none;
    }
    
    .hero-sub-image-gradient-top {
        display: block;
    }
    
    .hero-sub-text-section {
        position: relative;
        width: 100%;
        height: auto;
        order: 1;
        padding: 40px 20px;
    }
    
    .hero-sub-text-wrapper {
        max-width: 100%;
        padding: 0;
    }
    
    .hero-sub-text .body-t-lg {
        font-size: 16px !important;
        margin-bottom: 12px;
    }
}

@media (max-width: 480px) {
    .hero-main {
        height: 520px;
    }
    
    .hero-main-content {
        align-items: flex-start;
        padding-top: 40px;
    }
    
    .hero-content-wrapper {
        padding: 0 16px;
    }
    
    .hero-title-line {
        font-size: 28px !important;
        font-weight: 400 !important;
    }
    
    .hero-sub-text-section {
        padding: 30px 16px;
    }
    
    .hero-sub-text .body-t-lg {
        font-size: 14px !important;
        margin-bottom: 10px;
    }
}
</style>