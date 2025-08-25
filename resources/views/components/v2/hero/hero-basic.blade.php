@props([
    'mainTitle1' => "공실관리 • 사옥마련의",
    'mainTitle2' => '새로운 기준',
    'mainTitle3' => '공실앤톡과 함께하세요',
    'mainTitle1Bold' => [], // 굵게 표시할 텍스트 배열
    'mainTitle2Bold' => ['새로운 기준'],
    'mainTitle3Bold' => ['공실앤톡'],
    'mainBackgroundImage' => '/assets/media/main_page/banner_1.jpg',
    'subImage' => '/assets/media/main_page/banner_2.jpg',
    'subImageAlt' => '공실앤톡 서비스',
    'subText1' => '<span class="fw-700">조건 맞는 사옥, 찾기도 전에 하루가 끝</span>',
    'subText2' => '시간은 줄이고, 효율은 높이는 기업 전용 공간 서비스 공실앤톡과 함께',
    'subText3' => '<span class="fw-700">매년 수백만 원의 기회비용</span>',
    'subText4' => '부동산 공실은 시간과 수익을 동시에 잃게 만든다는 사실, 알고 계신가요?',
    'subText5' => '<span class="fw-700">임대인 10명 중 9명</span>',
    'subText6' => "이들은 '공실 기간 단축이 수익 안정에 큰 영향을 미친다'고 말합니다",
    'subText7' => '공실앤톡은 공실 해소는 물론 기업 맞춤 사옥 매칭부터 인테리어•가구 세팅까지 한 번에 해결합니다.',
    'subText8' => '공간의 가치는 높이고 안정적인 임대•운영 환경을 만들어 갑니다',
    'subText9' => '<span class="fw-700">지금 수백 명의 임대인과 수백 개 기업이 선택한</span>',
    'subText10' => '공실앤톡의 공간 솔루션을 만나보세요.',
    'containerClass' => '',
    'id' => 'hero-' . uniqid()
])

<div class="hero-basic-container {{ $containerClass }}" id="{{ $id }}">
    <!-- Main Hero -->
    <div class="hero-main">
        <div class="hero-main-content-section">
            <div class="hero-main-text-wrapper">
                <div class="hero-main-text">
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
        <div class="hero-main-image">
            <img src="{{ $mainBackgroundImage }}" alt="메인 배너">
            <div class="hero-main-image-gradient"></div>
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
    width: 100%;
    height: 735px;
    overflow: hidden;
    display: flex;
    position: relative;
    background: #F8F5F2;
}

.hero-main-content-section {
    position: absolute;
    left: 0;
    top: 0;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    z-index: 2;
}

.hero-main-text-wrapper {
    max-width: 540px;
    padding: 60px;
}

.hero-main-text {
    width: 100%;
}

.hero-main-title {
    text-align: left;
    margin: 0;
}

.hero-title-line {
    display: block;
    font-size: 52px !important;
    font-weight: 400 !important;
    line-height: 1.4;
    color: #222;
}

.hero-title-line strong {
    font-weight: 700 !important;
}

.hero-main-image {
    position: absolute;
    right: 0;
    top: 0;
    width: 50%;
    height: 100%;
}

.hero-main-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: right 30% top 0;
}

.hero-main-image-gradient {
    position: absolute;
    top: 0;
    left: 0;
    width: 150px;
    height: 100%;
    background: linear-gradient(270deg, rgba(248, 245, 242, 0) 0%, #F8F5F2 100%);
    z-index: 1;
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
    font-size: 18px;
}

.hero-sub-text .body-t-lg .fw-700,
.hero-sub-text .body-t-lg span[class*="fw-"] {
    font-size: inherit !important;
    font-weight: 700 !important;
}

.hero-sub-text .body-t-lg:last-child {
    margin-bottom: 0;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .hero-main {
        height: auto;
        min-height: 520px;
        flex-direction: column;
    }
    
    .hero-main-content-section {
        position: relative;
        width: 100%;
        height: auto;
        order: 1;
        padding: 40px 20px;
        justify-content: center;
    }
    
    .hero-main-text-wrapper {
        max-width: 100%;
        padding: 0;
    }
    
    .hero-main-image {
        position: relative;
        width: 100%;
        height: 300px;
        order: 2;
    }
    
    .hero-main-image-gradient {
        display: none;
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
    
    .hero-sub-text .body-t-lg .fw-700,
    .hero-sub-text .body-t-lg span[class*="fw-"] {
        font-size: inherit !important;
    }
}

@media (max-width: 480px) {
    .hero-main-content-section {
        padding: 30px 16px;
    }
    
    .hero-title-line {
        font-size: 28px !important;
        font-weight: 400 !important;
    }
    
    .hero-main-image {
        height: 250px;
    }
    
    .hero-sub-text-section {
        padding: 30px 16px;
    }
    
    .hero-sub-text .body-t-lg {
        font-size: 14px !important;
        margin-bottom: 10px;
    }
    
    .hero-sub-text .body-t-lg .fw-700,
    .hero-sub-text .body-t-lg span[class*="fw-"] {
        font-size: inherit !important;
    }
}
</style>