{{--
    Text Image Carousel Component
    좌측 텍스트 + 우측 이미지 캐러셀 컴포넌트
--}}

@props([
    'colorText' => '공실앤톡의 특별함',
    'colorTextColor' => '#DC9086',
    'title' => '완벽한 솔루션을 위한<br>차별화된 서비스',
    'description' => '부동산 전문가와 함께하는 맞춤형 상담 서비스를 제공하며,<br>AI 기반 빠른 매물 분석으로 최적의 선택을 도와드립니다.<br>입주부터 운영까지 체계적인 관리 서비스를 제공합니다.',
    'buttonText' => '자세히 보기',
    'buttonLink' => '#',
    'images' => [
        [
            'src' => '/assets/media/area/20/3.png',
            'caption' => '전문 상담 서비스'
        ],
        [
            'src' => '/assets/media/area/20/3.png',
            'caption' => '전문 상담 서비스'
        ],
        [
            'src' => '/assets/media/area/20/3.png',
            'caption' => '완벽한 관리'
        ]
    ],
    'containerClass' => '',
    'id' => 'gsnt-tic-' . uniqid()
])

<div class="gsnt-tic-container {{ $containerClass }}" id="{{ $id }}">
    <div class="gsnt-tic-content">
        <!-- 좌측 텍스트 영역 -->
        <div class="gsnt-tic-text-section">
            <!-- 1행: 작은 색상 텍스트 -->
            <p class="gsnt-tic-color-text" style="color: {{ $colorTextColor }};">{{ $colorText }}</p>
            
            <!-- 2행: 큰 굵은 텍스트 -->
            <h2 class="gsnt-tic-title">{!! $title !!}</h2>
            
            <!-- 3행: 회색 작은 텍스트 -->
            <p class="gsnt-tic-description">{!! $description !!}</p>
            
            <!-- 버튼 -->
            <a href="{{ $buttonLink }}" class="gsnt-tic-button">
                <span>{{ $buttonText }}</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="gsnt-tic-button-icon">
                    <path d="M6 3L11 8L6 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        
        <!-- 우측 이미지 캐러셀 영역 -->
        <div class="gsnt-tic-carousel-section">
            <div class="gsnt-tic-carousel-container">
                <div class="gsnt-tic-carousel-track">
                    @foreach($images as $index => $image)
                        <div class="gsnt-tic-slide {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                            <div class="gsnt-tic-image-wrapper">
                                <img src="{{ $image['src'] }}" alt="Slide {{ $index + 1 }}" class="gsnt-tic-image">
                                <div class="gsnt-tic-caption">
                                    {{ $image['caption'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.gsnt-tic-container {
    width: 100%;
    max-width: 1380px;
    margin: 0 auto;
    padding: 0 50px;
    box-sizing: border-box;
}

.gsnt-tic-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}

/* 좌측 텍스트 영역 */
.gsnt-tic-text-section {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.gsnt-tic-color-text {
    font-size: 16px;
    font-weight: 500;
    margin: 0;
    line-height: 1.4;
}

.gsnt-tic-title {
    font-size: 48px;
    font-weight: 700;
    color: #222;
    margin: 0;
    line-height: 1.2;
}

.gsnt-tic-description {
    font-size: 16px;
    font-weight: 400;
    color: #666;
    margin: 0;
    line-height: 1.6;
}

.gsnt-tic-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background-color: #222222;
    color: white !important;
    font-size: 16px;
    font-weight: 600;
    padding: 16px 32px;
    border-radius: 8px;
    text-decoration: none;
    align-self: flex-start;
    transition: all 0.3s ease;
}

.gsnt-tic-button-icon {
    flex-shrink: 0;
    transition: transform 0.3s ease;
}

.gsnt-tic-button:hover .gsnt-tic-button-icon {
    transform: translateX(2px);
}

.gsnt-tic-button:hover {
    background-color: #333;
    text-decoration: none;
    color: white !important;
}

.gsnt-tic-button span {
    color: white !important;
}

.gsnt-tic-button:hover span {
    color: white !important;
}

/* 우측 이미지 캐러셀 영역 */
.gsnt-tic-carousel-section {
    position: relative;
    height: 500px;
    overflow: hidden;
    padding-right: 150px;
}

.gsnt-tic-carousel-container {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: visible;
}

.gsnt-tic-carousel-track {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gsnt-tic-slide {
    position: absolute;
    width: 400px;
    height: 400px;
    transition: all 0.5s ease;
    cursor: pointer;
    opacity: 0;
    transform: scale(0.8) translateX(100%);
    z-index: 1;
    visibility: hidden;
}

.gsnt-tic-slide.active {
    opacity: 1;
    transform: scale(1) translateX(0);
    z-index: 3;
    left: 0;
    visibility: visible;
}

.gsnt-tic-slide.next {
    opacity: 0.7;
    transform: scale(0.8) translateX(30%);
    z-index: 2;
    right: -50px;
    visibility: visible;
}

.gsnt-tic-slide.prev {
    opacity: 0.5;
    transform: scale(0.7) translateX(-150%);
    z-index: 1;
    left: -250px;
    visibility: visible;
}

.gsnt-tic-image-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    border-radius: 16px;
    overflow: hidden;
}

.gsnt-tic-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.gsnt-tic-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: white;
    color: #222;
    font-size: 16px;
    font-weight: 600;
    padding: 16px 20px;
    text-align: left;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gsnt-tic-slide.active .gsnt-tic-caption {
    opacity: 1;
}

/* Tablet */
@media (max-width: 1024px) {
    .gsnt-tic-container {
        padding: 0 30px;
    }
    
    .gsnt-tic-content {
        gap: 60px;
    }
    
    .gsnt-tic-title {
        font-size: 40px;
    }
    
    .gsnt-tic-carousel-section {
        height: 400px;
    }
    
    .gsnt-tic-slide {
        width: 300px;
        height: 300px;
    }
}

/* Mobile */
@media (max-width: 768px) {
    .gsnt-tic-container {
        padding: 0 20px;
    }
    
    .gsnt-tic-content {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .gsnt-tic-color-text {
        font-size: 14px;
    }
    
    .gsnt-tic-title {
        font-size: 32px;
    }
    
    .gsnt-tic-description {
        font-size: 14px;
    }
    
    .gsnt-tic-button {
        font-size: 14px;
        padding: 14px 28px;
    }
    
    .gsnt-tic-carousel-section {
        height: 350px;
    }
    
    .gsnt-tic-slide {
        width: 250px;
        height: 250px;
    }
    
    .gsnt-tic-caption {
        font-size: 14px;
        padding: 12px 16px;
    }
}

@media (max-width: 480px) {
    .gsnt-tic-container {
        padding: 0 16px;
    }
    
    .gsnt-tic-title {
        font-size: 28px;
    }
    
    .gsnt-tic-description {
        font-size: 13px;
    }
    
    .gsnt-tic-carousel-section {
        height: 300px;
    }
    
    .gsnt-tic-slide {
        width: 200px;
        height: 200px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const containers = document.querySelectorAll('.gsnt-tic-carousel-container');
    
    containers.forEach(container => {
        const slides = container.querySelectorAll('.gsnt-tic-slide');
        let currentIndex = 0;
        let isAnimating = false;
        
        function updateSlides() {
            slides.forEach((slide, index) => {
                slide.classList.remove('active', 'next', 'prev');
                
                if (index === currentIndex) {
                    slide.classList.add('active');
                } else if (index === (currentIndex + 1) % slides.length) {
                    slide.classList.add('next');
                } else if (index === (currentIndex - 1 + slides.length) % slides.length) {
                    slide.classList.add('prev');
                }
            });
        }
        
        function nextSlide() {
            if (isAnimating) return;
            isAnimating = true;
            
            currentIndex = (currentIndex + 1) % slides.length;
            updateSlides();
            
            setTimeout(() => {
                isAnimating = false;
            }, 500);
        }
        
        // 초기 슬라이드 설정
        updateSlides();
        
        // 클릭으로 다음 슬라이드
        slides.forEach(slide => {
            slide.addEventListener('click', nextSlide);
        });
        
        // 터치 이벤트
        let touchStartX = 0;
        let touchEndX = 0;
        
        container.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        });
        
        container.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            const swipeDistance = touchStartX - touchEndX;
            
            if (Math.abs(swipeDistance) > 50) {
                if (swipeDistance > 0) {
                    nextSlide();
                }
            }
        });
        
        // 자동 재생 (옵션)
        // setInterval(nextSlide, 4000);
    });
});
</script>