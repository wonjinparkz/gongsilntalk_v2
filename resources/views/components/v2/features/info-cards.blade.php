{{--
    Info Cards Component
    4개의 카드로 구성된 정보 카드 컴포넌트
--}}

@props([
    'title' => '정보 카드',
    'cards' => [
        [
            'title' => '카드 제목 1',
            'description' => [
                '첫 번째 설명 라인입니다.',
                '두 번째 설명 라인입니다.',
                '세 번째 설명 라인입니다.'
            ],
            'image' => '/assets/media/type3_img_1.png'
        ],
        [
            'title' => '카드 제목 2',
            'description' => [
                '첫 번째 설명 라인입니다.',
                '두 번째 설명 라인입니다.',
                '세 번째 설명 라인입니다.'
            ],
            'image' => '/assets/media/type3_img_1.png'
        ],
        [
            'title' => '카드 제목 3',
            'description' => [
                '첫 번째 설명 라인입니다.',
                '두 번째 설명 라인입니다.',
                '세 번째 설명 라인입니다.'
            ],
            'image' => '/assets/media/type3_img_1.png'
        ],
        [
            'title' => '카드 제목 4',
            'description' => [
                '첫 번째 설명 라인입니다.',
                '두 번째 설명 라인입니다.',
                '세 번째 설명 라인입니다.'
            ],
            'image' => '/assets/media/type3_img_1.png'
        ]
    ],
    'footerText' => [
        '하단 설명 첫 번째 라인입니다.',
        '하단 설명 두 번째 라인입니다.'
    ],
    'containerClass' => '',
    'id' => 'info-cards-' . uniqid()
])

<div class="info-cards-container {{ $containerClass }}" id="{{ $id }}">
    <div class="info-cards-wrapper">
        @if($title)
            <h2 class="info-cards-title">{!! $title !!}</h2>
        @endif
        
        <div class="info-cards-grid">
            @foreach($cards as $index => $card)
                <div class="info-card {{ $index === 3 ? 'card-empty' : '' }}">
                    @if($index === 3)
                        <!-- 4번째 카드는 빈 카드 -->
                        <div class="card-empty-content"></div>
                    @else
                        <div class="info-card-content">
                            <h3 class="card-title">{{ $card['title'] }}</h3>
                            <div class="card-description">
                                @foreach($card['description'] as $line)
                                    <p class="description-line">{{ $line }}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-image">
                            <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" />
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        
        @if($footerText && count($footerText) > 0)
            <div class="info-cards-footer">
                @foreach($footerText as $line)
                    <p class="footer-line">{{ $line }}</p>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
.info-cards-container {
    width: 100%;
    background: #FFFFFF;
}

.info-cards-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.info-cards-title {
    font-size: 42px;
    font-weight: 700;
    color: #222;
    text-align: center;
    margin: 0 0 60px 0;
    line-height: 1.3;
}

.info-cards-title br {
    display: block;
}

.info-cards-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-bottom: 40px;
}

.info-card {
    display: flex;
    background: #FFFFFF;
    border-radius: 16px;
    overflow: hidden;
    height: 250px;
}

.info-card-content {
    flex: 0 0 45%;
    background: #FFFCA8;
    padding: 0 0 0 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: left;
}

.card-title {
    font-size: 32px;
    font-weight: 700;
    color: #222;
    margin: 0 0 12px 0;
    line-height: 1.3;
}

.card-description {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.description-line {
    font-size: 16px;
    font-weight: 400;
    color: #333;
    line-height: 1.4;
    margin: 0;
}

.card-image {
    flex: 0 0 55%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.card-empty {
    background: rgba(255, 252, 168, 0.5) !important;
}

.card-empty-content {
    width: 100%;
    height: 100%;
}

.info-cards-footer {
    text-align: center;
    margin-top: 20px;
}

.footer-line {
    font-size: 14px;
    font-weight: 400;
    color: #999;
    line-height: 1.5;
    margin: 0;
}

.footer-line:not(:last-child) {
    margin-bottom: 4px;
}

/* Tablet Responsive */
@media (max-width: 1024px) {
    .info-cards-grid {
        gap: 20px;
    }
    
    .info-card {
        height: 180px;
    }
    
    .info-card-content {
        padding: 20px 16px;
    }
    
    .card-title {
        font-size: 28px;
    }
    
    .description-line {
        font-size: 14px;
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    
    .info-cards-title {
        font-size: 32px;
        margin-bottom: 40px;
    }
    
    .info-cards-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .info-card {
        flex-direction: column;
        height: auto;
    }
    
    .info-card:nth-child(4) {
        display: none;
    }
    
    .info-card-content {
        flex: none;
        order: 2;
        padding: 16px 20px;
    }
    
    .card-image {
        flex: none;
        order: 1;
        height: 160px;
    }
    
    .card-title {
        font-size: 24px;
        margin-bottom: 8px;
    }
    
    .description-line {
        font-size: 14px;
    }
    
    .footer-line {
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    
    .info-cards-title {
        font-size: 28px;
    }
    
    .info-card-content {
        padding: 12px 16px;
    }
    
    .card-image {
        height: 140px;
    }
    
    .card-title {
        font-size: 20px;
    }
    
    .description-line {
        font-size: 12px;
    }
}
</style>