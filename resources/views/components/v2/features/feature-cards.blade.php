@props([
    'cards' => [
        [
            'subtitle' => '최다 사무실 보유!',
            'title' => '보유 사무실 수<br>4,200개+',
            'description' => '',
            'image' => '/assets/media/m_bn_img_1.png',
        ],
        [
            'subtitle' => '빠른 정보 제공',
            'title' => '실시간 알림<br>24/7',
            'description' => '',
            'image' => '/assets/media/m_bn_img_1.png',
        ],
        [
            'subtitle' => '간편한 프로세스',
            'title' => '원스톱<br>계약 시스템',
            'description' => '',
            'image' => '/assets/media/m_bn_img_1.png',
        ],
        [
            'subtitle' => '전국 최다!',
            'title' => '등록된 매물<br>15,000개+',
            'description' => '',
            'image' => '/assets/media/m_bn_img_1.png',
        ],
        [
            'subtitle' => '믿을 수 있는 거래',
            'title' => '검증된 중개사<br>2,500명+',
            'description' => '',
            'image' => '/assets/media/m_bn_img_1.png',
        ],
    ],
    'containerClass' => '',
    'id' => 'feature-cards-' . uniqid()
])

<div class="feature-cards-container {{ $containerClass }}" id="{{ $id }}">
    <div class="feature-cards-wrapper">
        <!-- Column 1: Single large card -->
        <div class="feature-column column-single">
            <div class="feature-card card-large">
                <div class="card-text-content">
                    @if($cards[0]['subtitle'])
                        <p class="card-subtitle">{{ $cards[0]['subtitle'] }}</p>
                    @endif
                    <h4 class="card-title">{!! $cards[0]['title'] !!}</h4>
                    @if($cards[0]['description'])
                        <p class="card-description">{{ $cards[0]['description'] }}</p>
                    @endif
                </div>
                <img src="{{ $cards[0]['image'] }}" alt="{{ strip_tags($cards[0]['title']) }}" class="card-image">
            </div>
        </div>
        
        <!-- Column 2: Two small cards -->
        <div class="feature-column column-double">
            <div class="feature-card card-small">
                <div class="card-content">
                    @if($cards[1]['subtitle'])
                        <p class="card-subtitle">{{ $cards[1]['subtitle'] }}</p>
                    @endif
                    <h4 class="card-title">{!! $cards[1]['title'] !!}</h4>
                    @if($cards[1]['description'])
                        <p class="card-description">{{ $cards[1]['description'] }}</p>
                    @endif
                </div>
                <img src="{{ $cards[1]['image'] }}" alt="{{ strip_tags($cards[1]['title']) }}" class="card-image">
            </div>
            <div class="feature-card card-small">
                <div class="card-content">
                    @if($cards[2]['subtitle'])
                        <p class="card-subtitle">{{ $cards[2]['subtitle'] }}</p>
                    @endif
                    <h4 class="card-title">{!! $cards[2]['title'] !!}</h4>
                    @if($cards[2]['description'])
                        <p class="card-description">{{ $cards[2]['description'] }}</p>
                    @endif
                </div>
                <img src="{{ $cards[2]['image'] }}" alt="{{ strip_tags($cards[2]['title']) }}" class="card-image">
            </div>
        </div>
        
        <!-- Column 3: Single large card -->
        <div class="feature-column column-single">
            <div class="feature-card card-large">
                <div class="card-text-content">
                    @if($cards[3]['subtitle'])
                        <p class="card-subtitle">{{ $cards[3]['subtitle'] }}</p>
                    @endif
                    <h4 class="card-title">{!! $cards[3]['title'] !!}</h4>
                    @if($cards[3]['description'])
                        <p class="card-description">{{ $cards[3]['description'] }}</p>
                    @endif
                </div>
                <img src="{{ $cards[3]['image'] }}" alt="{{ strip_tags($cards[3]['title']) }}" class="card-image">
            </div>
        </div>
        
        <!-- Column 4: Single large card -->
        <div class="feature-column column-single">
            <div class="feature-card card-large">
                <div class="card-text-content">
                    @if($cards[4]['subtitle'])
                        <p class="card-subtitle">{{ $cards[4]['subtitle'] }}</p>
                    @endif
                    <h4 class="card-title">{!! $cards[4]['title'] !!}</h4>
                    @if($cards[4]['description'])
                        <p class="card-description">{{ $cards[4]['description'] }}</p>
                    @endif
                </div>
                <img src="{{ $cards[4]['image'] }}" alt="{{ strip_tags($cards[4]['title']) }}" class="card-image">
            </div>
        </div>
    </div>
</div>

<style>
.feature-cards-container {
    width: 100%;
    padding: 60px 20px;
    background: #FAFAFA;
}

.feature-cards-wrapper {
    max-width: 1280px;
    margin: 0 auto;
    display: flex;
    gap: 13px;
    align-items: stretch;
}

.feature-column {
    flex: 1;
    display: flex;
    flex-direction: column;
    min-width: 250px;
}

.column-single {
    flex: 1;
}

.column-double {
    flex: 1;
    gap: 20px;
}

/* Large card style (single in column) */
.feature-card {
    background-color: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    overflow: hidden;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.card-large {
    text-align: left;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 40px 24px 24px 40px;
    height: 100%;
    position: relative;
}

.card-large .card-text-content {
    flex: 1;
}

.card-large .card-image {
    display: block;
    width: max(2vw, 130px);
    height: max(2vw, 130px);
    object-fit: contain;
    margin: auto 0 0 auto;
}

.card-large .card-subtitle {
    font-size: 18px;
    font-weight: 500;
    color: #666;
    margin-bottom: 8px;
    line-height: 1.4;
}

.card-large .card-title {
    font-size: 34px;
    font-weight: 700;
    color: #000;
    margin-bottom: 12px;
    line-height: 1.3;
}

.card-large .card-description {
    font-size: 16px;
    font-weight: 400;
    color: #212121;
    line-height: 1.6;
    margin-top: 8px;
}

/* Small card style (two in column) */
.card-small {
    align-items: center;
    display: flex;
    flex-direction: row;
    padding: 34px 24px 35px 40px;
    flex: 1;
}

.card-small .card-content {
    flex: 1;
}

.card-small .card-image {
    width: 60px;
    height: 60px;
    object-fit: contain;
    margin-left: 20px;
    flex-shrink: 0;
}

.card-small .card-subtitle {
    font-size: 18px;
    font-weight: 500;
    color: #666;
    margin-bottom: 8px;
    line-height: 1.4;
}

.card-small .card-title {
    font-size: 34px;
    font-weight: 700;
    color: #000;
    margin-bottom: 12px;
    line-height: 1.3;
}

.card-small .card-description {
    font-size: 16px;
    font-weight: 400;
    color: #212121;
    line-height: 1.6;
    margin-top: 8px;
}

/* Mobile Responsive */
@media (max-width: 1024px) {
    .feature-cards-wrapper {
        flex-wrap: wrap;
    }
    
    .feature-column {
        min-width: calc(50% - 10px);
    }
}

@media (max-width: 768px) {
    .feature-cards-container {
        padding: 40px 16px;
    }
    
    .feature-cards-wrapper {
        flex-direction: column;
        gap: 16px;
    }
    
    .feature-column {
        min-width: 100%;
        width: 100%;
    }
    
    .column-double {
        flex-direction: column;
        gap: 16px;
    }
    
    /* Small cards maintain horizontal layout on mobile */
    .card-small {
        flex-direction: row;
        padding: 30px 20px;
        align-items: center;
    }
    
    .card-small .card-image {
        margin-left: 16px;
        width: 50px;
        height: 50px;
    }
    
    .card-small .card-subtitle {
        font-size: 14px;
        margin-bottom: 4px;
    }
    
    .card-small .card-title {
        font-size: 18px;
    }
    
    .card-small .card-description {
        font-size: 13px;
    }
    
    .card-large {
        flex-direction: row;
        padding: 30px 20px;
        align-items: center;
    }
    
    .card-large .card-text-content {
        flex: 1;
        margin-right: 16px;
    }
    
    .card-large .card-image {
        width: 60px;
        height: 60px;
        margin: 0 0 0 16px;
        align-self: center;
        flex-shrink: 0;
    }
    
    .card-large .card-subtitle {
        font-size: 14px;
        margin-bottom: 4px;
    }
    
    .card-large .card-title {
        font-size: 20px;
    }
    
    .card-large .card-description {
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .feature-cards-container {
        padding: 30px 16px;
    }
    
    .feature-cards-wrapper {
        gap: 12px;
    }
    
    .column-double {
        gap: 12px;
    }
}
</style>