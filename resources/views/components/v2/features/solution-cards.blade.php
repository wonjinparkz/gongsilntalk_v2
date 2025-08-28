{{--
    Solution Cards Component
    이미지 기반 솔루션 카드 컴포넌트
--}}

@props([
    'title' => '공실앤톡의<br>완벽한 솔루션',
    'cards' => [
        [
            'badge' => '추천',
            'badgeColor' => '#FF6B35',
            'image' => '/assets/media/area/20/1.png',
            'title' => '매물 상담 서비스',
            'subtitle' => '전문가와 함께하는 맞춤 상담',
            'buttonText' => '자세히 보기',
            'buttonLink' => '#',
            'overlayColor' => 'rgba(255, 107, 53, 0.1)'
        ],
        [
            'badge' => 'HOT',
            'badgeColor' => '#DC3545',
            'image' => '/assets/media/area/20/1.png',
            'title' => '30초 제안서',
            'subtitle' => '빠른 매물 분석 및 제안',
            'buttonText' => '견적 받기',
            'buttonLink' => '#',
            'overlayColor' => 'rgba(220, 53, 69, 0.1)'
        ],
        [
            'badge' => 'NEW',
            'badgeColor' => '#28A745',
            'image' => '/assets/media/area/20/1.png',
            'title' => 'VR 촬영 서비스',
            'subtitle' => '360도 입체 공간 촬영',
            'buttonText' => '체험하기',
            'buttonLink' => '#',
            'overlayColor' => 'rgba(40, 167, 69, 0.1)'
        ],
        [
            'badge' => '인기',
            'badgeColor' => '#6F42C1',
            'image' => '/assets/media/area/20/1.png',
            'title' => '공간 컨설팅',
            'subtitle' => '맞춤형 인테리어 설계',
            'buttonText' => '신청하기',
            'buttonLink' => '#',
            'overlayColor' => 'rgba(111, 66, 193, 0.1)'
        ]
    ],
    'containerClass' => '',
    'id' => 'gsnt-sc-' . uniqid()
])

<div class="gsnt-sc-container {{ $containerClass }}" id="{{ $id }}">
    @if($title)
        <h2 class="gsnt-sc-main-title">{!! $title !!}</h2>
    @endif
    
    <div class="gsnt-sc-cards-grid">
        @foreach($cards as $index => $card)
            <div class="gsnt-sc-card" data-overlay-color="{{ $card['overlayColor'] }}">
                <div class="gsnt-sc-card-inner">
                    <!-- 배경 이미지 -->
                    <div class="gsnt-sc-image-bg" style="background-image: url('{{ $card['image'] }}');"></div>
                    
                    <!-- 오버레이 -->
                    <div class="gsnt-sc-overlay" style="background: {{ $card['overlayColor'] }};"></div>
                    
                    <!-- 뱃지 -->
                    <div class="gsnt-sc-badge">
                        {{ $card['badge'] }}
                    </div>
                    
                    <!-- 하단 콘텐츠 영역 -->
                    <div class="gsnt-sc-content">
                        <div class="gsnt-sc-content-bg"></div>
                        <div class="gsnt-sc-content-text">
                            <h3 class="gsnt-sc-title">{{ $card['title'] }}</h3>
                            <p class="gsnt-sc-subtitle">{{ $card['subtitle'] }}</p>
                            <div class="gsnt-sc-button-row">
                                <a href="{{ $card['buttonLink'] }}" class="gsnt-sc-button">
                                    <span>{{ $card['buttonText'] }}</span>
                                </a>
                                <div class="gsnt-sc-icon">
                                    <svg width="20" height="20" viewBox="0 0 16 16" fill="none" class="gsnt-sc-arrow">
                                        <path d="M6 3L11 8L6 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.gsnt-sc-container {
    width: 100%;
    max-width: 1380px;
    margin: 0 auto;
    padding: 0 50px;
    box-sizing: border-box;
}

.gsnt-sc-main-title {
    font-size: 48px;
    font-weight: 700;
    color: #222;
    text-align: center;
    line-height: 1.3;
    margin: 0 0 60px 0;
}

.gsnt-sc-cards-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

.gsnt-sc-card {
    position: relative;
    height: 400px;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: all 0.4s ease;
}

.gsnt-sc-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.gsnt-sc-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
}

.gsnt-sc-image-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    transition: all 0.4s ease;
}

.gsnt-sc-card:hover .gsnt-sc-image-bg {
    filter: blur(3px);
    transform: scale(1.05);
}

.gsnt-sc-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.gsnt-sc-card:hover .gsnt-sc-overlay {
    opacity: 1;
}

.gsnt-sc-badge {
    position: absolute;
    top: 20px;
    left: 20px;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    color: #222;
    background-color: #F1F4F8;
    z-index: 3;
    backdrop-filter: blur(10px);
}

.gsnt-sc-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 2;
}

.gsnt-sc-content-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
}

.gsnt-sc-content-text {
    position: relative;
    padding: 40px 24px 24px;
    z-index: 1;
}

.gsnt-sc-button-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.gsnt-sc-icon {
    flex-shrink: 0;
    color: #222;
}

.gsnt-sc-title {
    font-size: 24px;
    font-weight: 700;
    color: #222;
    margin: 0 0 8px 0;
    line-height: 1.3;
}

.gsnt-sc-subtitle {
    font-size: 16px;
    font-weight: 400;
    color: #666;
    margin: 0 0 20px 0;
    line-height: 1.4;
}

.gsnt-sc-button {
    display: inline-block;
    color: #222;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
}

.gsnt-sc-button:hover {
    color: #666;
    text-decoration: none;
}

.gsnt-sc-arrow {
    color: #222;
}

/* Tablet */
@media (max-width: 1024px) {
    .gsnt-sc-container {
        padding: 0 30px;
    }
    
    .gsnt-sc-cards-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }
    
    .gsnt-sc-card {
        height: 350px;
    }
    
    .gsnt-sc-main-title {
        font-size: 40px;
        margin-bottom: 50px;
    }
}

/* Mobile */
@media (max-width: 768px) {
    .gsnt-sc-container {
        padding: 0 20px;
    }
    
    .gsnt-sc-cards-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .gsnt-sc-card {
        height: 320px;
    }
    
    .gsnt-sc-main-title {
        font-size: 32px;
        margin-bottom: 40px;
    }
    
    .gsnt-sc-title {
        font-size: 20px;
    }
    
    .gsnt-sc-subtitle {
        font-size: 14px;
    }
    
    .gsnt-sc-content-text {
        padding: 30px 20px 20px;
    }
    
    .gsnt-sc-badge {
        top: 16px;
        left: 16px;
        padding: 3px 10px;
        font-size: 11px;
    }
}

@media (max-width: 480px) {
    .gsnt-sc-container {
        padding: 0 16px;
    }
    
    .gsnt-sc-cards-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .gsnt-sc-main-title {
        font-size: 28px;
    }
    
    .gsnt-sc-card {
        height: 280px;
    }
    
    .gsnt-sc-title {
        font-size: 18px;
    }
    
    .gsnt-sc-subtitle {
        font-size: 13px;
    }
    
    .gsnt-sc-button {
        font-size: 13px;
        padding: 10px 16px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.gsnt-sc-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            // 호버 효과 추가 처리가 필요한 경우
        });
        
        card.addEventListener('mouseleave', function() {
            // 호버 해제 효과 추가 처리가 필요한 경우
        });
    });
});
</script>