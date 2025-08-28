{{--
    Office Visual Component
    좌측 텍스트 영역과 우측 이미지를 가진 오피스 비주얼 헤더 컴포넌트
--}}

@props([
    'title' => '독립형 오피스',
    'description' => '독립형 오피스는 프라이빗한 사무 공간과 함께<br>라운지, 미팅룸, 화장실 등 다양한 공용 공간을 제공합니다.<br>공유오피스의 편리함과 프라이빗한 환경을 한곳에서 경험해 보세요.',
    'info' => [
        ['label' => '추천 인원', 'value' => '1-30인'],
        ['label' => '추천 대상', 'value' => '소규모 팀, 스타트업'],
        ['label' => '최소 계약 기간', 'value' => '1개월'],
    ],
    'buttonText' => '최저가 견적 받기',
    'buttonLink' => '#',
    'buttonOnClick' => '',
    'desktopImage' => '/assets/media/type3_img_1.png',
    'mobileImage' => '/assets/media/type3_img_1.png',
    'imageAlt' => '오피스 이미지',
    'backgroundColor' => '#FFFFFF',
    'containerClass' => '',
    'id' => 'office-visual-' . uniqid()
])

<header class="office-visual-container {{ $containerClass }}" id="{{ $id }}" style="background-color: {{ $backgroundColor }}; border:0;">
    <div class="office-visual-wrapper">
        <div class="office-visual-inner">
            <h2 class="office-visual-title">{{ $title }}</h2>
            <div class="office-visual-text">
                {!! $description !!}
            </div>
            
            @if($info && count($info) > 0)
            <dl class="office-visual-info">
                @foreach($info as $item)
                    <dt>{{ $item['label'] }}</dt>
                    <dd data-label="{{ $item['label'] }}">{{ $item['value'] }}</dd>
                @endforeach
            </dl>
            @endif
            
            @if($buttonText)
            <div class="office-btn-group">
                <a href="{{ $buttonLink }}" 
                   class="btn-base"
                   @if($buttonOnClick) onclick="{{ $buttonOnClick }}" @endif>
                    {{ $buttonText }}
                </a>
            </div>
            @endif
        </div>
    </div>
    
    <div class="office-visual-img">
        <img src="{{ $desktopImage }}" alt="{{ $imageAlt }}" class="img-desktop">
        <img src="{{ $mobileImage }}" alt="{{ $imageAlt }}" class="img-mobile">
    </div>
</header>

<style>
.office-visual-container {
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: relative;
    background-color: #FFFFFF;
    padding: 0;
    min-height: 720px;
}

.office-visual-wrapper {
    max-width: 1380px;
    width: 100%;
    margin: 0 auto;
    display: flex;
    align-items: center;
    min-height: 720px;
    position: relative;
    z-index: 2;
}

.office-visual-inner {
    width: 100%;
    max-width: 540px;
    padding: 80px 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: left;
}

.office-visual-title {
    font-size: 52px;
    font-weight: 700;
    line-height: 1.3;
    color: #40484F;
    margin: 0 0 20px 0;
    letter-spacing: -0.02em;
}

.office-visual-text {
    font-size: 16px;
    font-weight: 400;
    line-height: 1.75;
    color: #6D757C;
    letter-spacing: -0.01em;
}

.office-visual-info {
    --dt_width: 96px;
    display: flex;
    flex-direction: column;
    gap: 0;
    width: min(100%, 336px);
    margin-top: 20px;
    margin-bottom: 40px;
    padding: 16px 20px;
    background-color: #F6F8FA;
    border-radius: 8px 8px 0 0;
}

.office-visual-info dt {
    display: none;
}

.office-visual-info dd {
    display: flex;
    align-items: center;
    padding: 12px 0;
    font-size: 14px;
    font-weight: 400;
    color: #40484F;
    margin: 0;
}

.office-visual-info dd:last-child {
    padding-bottom: 0;
}

.office-visual-info dd:first-of-type {
    padding-top: 0;
}

.office-visual-info dd::before {
    content: attr(data-label);
    font-weight: 600;
    color: #40484F;
    margin-right: 16px;
    min-width: var(--dt_width);
}

.office-btn-group {
    display: flex;
    gap: 12px;
}

.btn-base {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 14px 36px;
    font-size: 15px;
    font-weight: 600;
    color: #fff;
    background-color: #40484F;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    min-width: 160px;
    letter-spacing: -0.01em;
}

.btn-base:hover {
    background-color: #2C3338;
}

.office-visual-img {
    position: absolute;
    right: 0;
    top: 0;
    width: 55%;
    height: 100%;
    overflow: hidden;
    z-index: 1;
}

.office-visual-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.img-mobile {
    display: none;
}

.hidden-pc {
    display: none;
}

/* Tablet Responsive */
@media (max-width: 1024px) {
    .office-visual-wrapper {
        min-height: 480px;
    }
    
    .office-visual-inner {
        padding: 60px 60px 60px 80px;
    }
    
    .office-visual-title {
        font-size: 38px;
    }
    
    .office-visual-text {
        font-size: 15px;
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .office-visual-wrapper {
        flex-direction: column;
        min-height: auto;
    }
    
    .office-visual-inner {
        flex: 1 1 auto;
        padding: 48px 24px;
        order: 2;
    }
    
    .office-visual-title {
        font-size: 34px;
        margin-bottom: 16px;
    }
    
    .office-visual-text {
        font-size: 14px;
        margin-bottom: 24px;
        line-height: 1.7;
    }
    
    .office-visual-info {
        width: 100%;
        margin-top: 16px;
        padding: 14px 16px;
        margin-bottom: 28px;
    }
    
    .office-visual-info dd {
        padding: 10px 0;
        font-size: 13px;
    }
    
    .office-visual-info dd::before {
        font-size: 13px;
        min-width: 75px;
    }
    
    .office-visual-img {
        position: relative;
        flex: 1 1 auto;
        width: 100%;
        height: 280px;
        order: 1;
    }
    
    .img-desktop {
        display: none;
    }
    
    .img-mobile {
        display: block;
    }
    
    .hidden-pc {
        display: inline;
    }
    
    .btn-base {
        width: 100%;
        padding: 13px 24px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .office-visual-inner {
        padding: 36px 20px;
    }
    
    .office-visual-title {
        font-size: 24px;
    }
    
    .office-visual-text {
        font-size: 13px;
    }
    
    .office-visual-info {
        width: 100%;
        margin-top: 12px;
        padding: 12px 14px;
    }
    
    .office-visual-info dd {
        padding: 8px 0;
        font-size: 12px;
    }
    
    .office-visual-info dd::before {
        font-size: 12px;
        min-width: 65px;
    }
    
    .office-visual-img {
        height: 240px;
    }
    
    .btn-base {
        font-size: 13px;
        padding: 12px 20px;
    }
}
</style>