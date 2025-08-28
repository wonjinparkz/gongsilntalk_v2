{{--
    Feature Showcase Component  
    작은 색상 텍스트 + 큰 제목 + 3개 카드 구조 컴포넌트
--}}

@props([
    'colorText' => '공실앤톡의 특별함',
    'colorTextColor' => '#4A90E2',
    'lightTitle' => '완벽한 솔루션을 위한',
    'boldTitle' => '차별화된 서비스',
    'cards' => [
        [
            'image' => '/assets/media/area/20/2.png',
            'title' => '전문 상담',
            'description' => '부동산 전문가와 함께하는 맞춤형 상담 서비스를 제공합니다'
        ],
        [
            'image' => '/assets/media/area/20/2.png',
            'title' => '빠른 분석',
            'description' => 'AI 기반 빠른 매물 분석으로 최적의 선택을 도와드립니다'
        ],
        [
            'image' => '/assets/media/area/20/2.png',
            'title' => '완벽한 관리',
            'description' => '입주부터 운영까지 체계적인 관리 서비스를 제공합니다'
        ]
    ],
    'containerClass' => '',
    'id' => 'gsnt-fs-' . uniqid()
])

<div class="gsnt-fs-container {{ $containerClass }}" id="{{ $id }}">
    <!-- 헤더 텍스트 영역 -->
    <div class="gsnt-fs-header">
        <!-- 1행: 작은 색상 텍스트 -->
        <p class="gsnt-fs-color-text" style="color: {{ $colorTextColor }};">{{ $colorText }}</p>
        
        <!-- 2행: 큰 얇은 텍스트 -->
        <h2 class="gsnt-fs-light-title">{{ $lightTitle }}</h2>
        
        <!-- 3행: 큰 굵은 텍스트 -->
        <h2 class="gsnt-fs-bold-title">{{ $boldTitle }}</h2>
    </div>
    
    <!-- 카드 영역 -->
    <div class="gsnt-fs-cards-grid">
        @foreach($cards as $index => $card)
            <div class="gsnt-fs-card">
                <!-- 1:1 라운드 이미지 -->
                <div class="gsnt-fs-image-wrapper">
                    <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" class="gsnt-fs-image">
                </div>
                
                <!-- 텍스트 콘텐츠 -->
                <div class="gsnt-fs-content">
                    <h3 class="gsnt-fs-card-title">{{ $card['title'] }}</h3>
                    <p class="gsnt-fs-card-description">{{ $card['description'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.gsnt-fs-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 50px;
    box-sizing: border-box;
}

.gsnt-fs-header {
    text-align: left;
    margin-bottom: 60px;
}

.gsnt-fs-color-text {
    font-size: 16px;
    font-weight: 500;
    margin: 0 0 16px 0;
    line-height: 1.4;
}

.gsnt-fs-light-title {
    font-size: 48px;
    font-weight: 300;
    color: #222;
    margin: 0 0 8px 0;
    line-height: 1.2;
}

.gsnt-fs-bold-title {
    font-size: 48px;
    font-weight: 700;
    color: #222;
    margin: 0;
    line-height: 1.2;
}

.gsnt-fs-cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.gsnt-fs-card {
    text-align: left;
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    overflow: hidden;
}

.gsnt-fs-card:hover {
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    transform: translateY(-5px);
}

.gsnt-fs-image-wrapper {
    width: 100%;
    aspect-ratio: 1 / 1;
    overflow: hidden;
}

.gsnt-fs-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gsnt-fs-card:hover .gsnt-fs-image {
    transform: scale(1.05);
}

.gsnt-fs-content {
    padding: 50px 30px;
}

.gsnt-fs-card-title {
    font-size: 32px;
    font-weight: 700;
    color: #222;
    margin: 0 0 16px 0;
    line-height: 1.3;
}

.gsnt-fs-card-description {
    font-size: 20px;
    font-weight: 400;
    color: #666;
    margin: 0;
    line-height: 1.6;
}

/* Tablet */
@media (max-width: 1024px) {
    .gsnt-fs-container {
        padding: 0 30px;
    }
    
    .gsnt-fs-header {
        margin-bottom: 50px;
    }
    
    .gsnt-fs-light-title,
    .gsnt-fs-bold-title {
        font-size: 40px;
    }
    
    .gsnt-fs-cards-grid {
        gap: 30px;
    }
    
    
    .gsnt-fs-card-title {
        font-size: 22px;
    }
    
    .gsnt-fs-card-description {
        font-size: 15px;
    }
}

/* Mobile */
@media (max-width: 768px) {
    .gsnt-fs-container {
        padding: 0 20px;
    }
    
    .gsnt-fs-header {
        margin-bottom: 40px;
    }
    
    .gsnt-fs-color-text {
        font-size: 14px;
    }
    
    .gsnt-fs-light-title,
    .gsnt-fs-bold-title {
        font-size: 32px;
    }
    
    .gsnt-fs-cards-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    
    .gsnt-fs-content {
        padding: 0 10px;
    }
    
    .gsnt-fs-card-title {
        font-size: 20px;
        margin-bottom: 12px;
    }
    
    .gsnt-fs-card-description {
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .gsnt-fs-container {
        padding: 0 16px;
    }
    
    .gsnt-fs-light-title,
    .gsnt-fs-bold-title {
        font-size: 28px;
    }
    
    .gsnt-fs-card-title {
        font-size: 24px;
    }
    
    .gsnt-fs-card-description {
        font-size: 16px;
    }
}
</style>