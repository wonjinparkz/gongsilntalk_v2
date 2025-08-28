{{--
    Product Comparison Component
    3개의 상품 비교 카드 컴포넌트
--}}

@props([
    'title' => '상품별 비교',
    'titleAlign' => 'center', // 'left', 'center', 'right' 
    'contentAlign' => 'left', // 카드 내용 텍스트 정렬
    'highlightCard' => 1, // 1, 2, 3 중 하나, null이면 하이라이트 없음
    'cards' => [
        [
            'image' => '/assets/media/main_page/f5.png',
            'title' => '독립형 오피스',
            'description' => '프라이빗하게 누리고 라운지, 미팅룸, 화장실 등 공용 공간은 더 넓게 누리는 사무실',
            'specs' => [
                ['label' => '최소 계약 기간', 'value' => '1개월'],
                ['label' => '추천 인원', 'value' => '1-30인'],
                ['label' => '추천 대상', 'value' => '소규모 팀, 스타트업'],
                ['label' => '특징', 'value' => '프라이빗 사무 공간 + 공용 공간'],
            ],
            'services' => [
                ['label' => '주요 서비스', 'items' => ['가구 풀 세팅', '56개 지점 공용 시설 (라운지, 미팅룸, 화장실 등)']],
            ],
            'benefits' => [
                ['label' => '무료 옵션', 'value' => '회사 사이니지 제작 및 부착'],
            ],
            'buttonText' => '문의하기',
            'buttonLink' => '#',
        ],
        [
            'image' => '/assets/media/main_page/f5.png',
            'title' => '독립형 오피스 프리미엄',
            'description' => '독립형 오피스가 제공하는 혜택에 더해 사무실 내 전용 다목적공간 OA존 등을 제공하는 프리미엄 사무실',
            'specs' => [
                ['label' => '최소 계약 기간', 'value' => '1개월'],
                ['label' => '추천 인원', 'value' => '30-50인'],
                ['label' => '추천 대상', 'value' => '스타트업, 중소기업, 대기업 TF'],
                ['label' => '특징', 'value' => '프라이빗 사무 공간 + 전용 공간 + 공용 공간'],
            ],
            'services' => [
                ['label' => '주요 서비스', 'items' => ['가구 풀 세팅', '56개 지점 공용 시설 (라운지, 미팅룸, 화장실 등)', '사무실 내 전용 공간']],
            ],
            'benefits' => [
                ['label' => '무료 옵션', 'value' => '회사 명판 제작 및 부착'],
            ],
            'buttonText' => '자세히 보기',
            'buttonLink' => '#',
        ],
        [
            'image' => '/assets/media/main_page/f5.png',
            'title' => '오픈 데스크',
            'description' => '패스트파이브에서 제공하는 공용 사무실 내 1개의 좌석을 지정하여 사용하는 고정석',
            'specs' => [
                ['label' => '최소 계약 기간', 'value' => '1개월'],
                ['label' => '추천 인원', 'value' => '1인'],
                ['label' => '추천 대상', 'value' => '프리랜서, 재택근무자, 외근직 종사자'],
                ['label' => '특징', 'value' => '사무실 내 고정석 + 공용 공간'],
            ],
            'services' => [
                ['label' => '주요 서비스', 'items' => ['56개 지점 공용 시설 (라운지, 미팅룸, 화장실 등)']],
            ],
            'benefits' => [
                ['label' => '무료 옵션', 'value' => '3층 보안 시설, 사무실 잠기 접소'],
            ],
            'buttonText' => '자세히 보기',
            'buttonLink' => '#',
        ],
    ],
    'containerClass' => '',
    'id' => 'gsnt-product-comparison-' . uniqid()
])

<div class="gsnt-pc-container {{ $containerClass }}" id="{{ $id }}">
    @if($title)
        <h2 class="gsnt-pc-main-title gsnt-pc-align-{{ $titleAlign }}">{{ $title }}</h2>
    @endif
    
    <div class="gsnt-pc-cards-wrapper">
        @foreach($cards as $index => $card)
            <div class="gsnt-pc-card {{ $highlightCard == ($index + 1) ? 'gsnt-pc-highlighted' : '' }}">
                <div class="gsnt-pc-image-wrapper">
                    <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" class="gsnt-pc-image">
                </div>
                
                <div class="gsnt-pc-content gsnt-pc-content-align-{{ $contentAlign }}">
                    <h3 class="gsnt-pc-title">{{ $card['title'] }}</h3>
                    <p class="gsnt-pc-description">{{ $card['description'] }}</p>
                    
                    <div class="gsnt-pc-info-section">
                        @foreach($card['specs'] as $spec)
                            <div class="gsnt-pc-info-item">
                                <div class="gsnt-pc-info-label">{{ $spec['label'] }}</div>
                                <div class="gsnt-pc-info-value">{{ $spec['value'] }}</div>
                            </div>
                        @endforeach
                        
                        @if(isset($card['services']))
                            @foreach($card['services'] as $service)
                                <div class="gsnt-pc-info-item">
                                    <div class="gsnt-pc-info-label">{{ $service['label'] }}</div>
                                    <div class="gsnt-pc-info-value">
                                        @foreach($service['items'] as $item)
                                            <p class="gsnt-pc-service-item">{{ $item }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        
                        @if(isset($card['benefits']))
                            @foreach($card['benefits'] as $benefit)
                                <div class="gsnt-pc-info-item">
                                    <div class="gsnt-pc-info-label">{{ $benefit['label'] }}</div>
                                    <div class="gsnt-pc-info-value">{{ $benefit['value'] }}</div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    
                    <div class="gsnt-pc-footer">
                        <a href="{{ $card['buttonLink'] }}" class="gsnt-pc-button {{ $highlightCard == ($index + 1) ? 'gsnt-pc-button-highlight' : '' }}">
                            <span>{{ $highlightCard == ($index + 1) ? '문의하기' : $card['buttonText'] }}</span>
                            <svg class="gsnt-pc-button-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M6 3L11 8L6 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.gsnt-pc-container {
    width: 100%;
}

.gsnt-pc-main-title {
    font-size: 42px;
    font-weight: 700;
    color: #222;
    text-align: center;
    margin: 0 0 60px 0;
}

.gsnt-pc-align-left {
    text-align: left !important;
}

.gsnt-pc-align-center {
    text-align: center !important;
}

.gsnt-pc-align-right {
    text-align: right !important;
}

.gsnt-pc-content-align-left {
    text-align: left !important;
}

.gsnt-pc-content-align-center {
    text-align: center !important;
}

.gsnt-pc-content-align-right {
    text-align: right !important;
}

.gsnt-pc-cards-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.gsnt-pc-card {
    background: #FFFFFF;
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.gsnt-pc-card.gsnt-pc-highlighted {
    background: #E2EAE1;
}

.gsnt-pc-image-wrapper {
    width: 100%;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 20px;
}

.gsnt-pc-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.gsnt-pc-content {
    padding: 32px 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.gsnt-pc-title {
    font-size: 24px;
    font-weight: 700;
    color: #222;
    margin: 0 0 12px 0;
}

.gsnt-pc-description {
    font-size: 18px;
    font-weight: 400;
    color: #666;
    line-height: 1.6;
    margin: 0 0 24px 0;
    min-height: 60px;
}

.gsnt-pc-info-section {
    padding: 0;
    margin-bottom: 0;
}

.gsnt-pc-info-item {
    margin: 0 -24px;
    padding: 16px 24px;
    border-bottom: 1px solid #E5E8EB;
}

.gsnt-pc-card.gsnt-pc-highlighted .gsnt-pc-info-item {
    border-bottom-color: #FFFFFF;
}

.gsnt-pc-info-item:last-child {
    border-bottom: none;
}

.gsnt-pc-info-label {
    display: block;
    font-size: 13px;
    font-weight: 400;
    color: #999;
    margin-bottom: 6px;
}

.gsnt-pc-info-value {
    display: block;
    font-size: 18px;
    font-weight: 500;
    color: #40484F;
}

.gsnt-pc-service-item {
    font-size: 18px;
    font-weight: 500;
    color: #40484F;
    margin: 0 0 6px 0;
    position: relative;
    padding-left: 12px;
}

.gsnt-pc-service-item:last-child {
    margin-bottom: 0;
}

.gsnt-pc-service-item::before {
    content: '•';
    position: absolute;
    left: 0;
    color: #999;
}

.gsnt-pc-footer {
    margin-top: auto;
    padding-top: 24px;
}

.gsnt-pc-button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 14px 20px;
    background: #FFFFFF;
    color: #666;
    border: 1px solid #E5E8EB;
    border-radius: 6px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    gap: 8px;
    box-sizing: border-box;
}

.gsnt-pc-button.gsnt-pc-button-highlight {
    background: #40484F !important;
    color: #FFFFFF !important;
    border-color: #40484F !important;
}

.gsnt-pc-button.gsnt-pc-button-highlight span {
    color: #FFFFFF !important;
}

.gsnt-pc-button.gsnt-pc-button-highlight svg path {
    stroke: #FFFFFF !important;
}

.gsnt-pc-button:hover {
    background: #F8F9FA;
    border-color: #999;
}

.gsnt-pc-button.gsnt-pc-button-highlight:hover {
    background: #2C3338 !important;
    border-color: #2C3338 !important;
}

.gsnt-pc-button-arrow {
    transition: transform 0.2s ease;
}

.gsnt-pc-button:hover .gsnt-pc-button-arrow {
    transform: translateX(2px);
}

/* Tablet Responsive */
@media (max-width: 1024px) {
    .gsnt-pc-cards-wrapper {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    
    .gsnt-pc-main-title {
        font-size: 32px;
        margin-bottom: 40px;
    }
    
    .gsnt-pc-cards-wrapper {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .gsnt-pc-title {
        font-size: 20px;
    }
    
    .gsnt-pc-description {
        font-size: 14px;
        min-height: auto;
    }
    
    .gsnt-pc-info-item {
        margin: 0 -20px;
        padding: 16px 20px;
    }
}

@media (max-width: 480px) {
    
    .gsnt-pc-main-title {
        font-size: 28px;
    }
    
    .gsnt-pc-content {
        padding: 24px 20px;
    }
    
    .gsnt-pc-image-wrapper {
        height: 160px;
        padding: 0;
    }
}
</style>