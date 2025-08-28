{{--
    Dual Office Showcase Component
    2개의 오피스 쇼케이스를 나란히 표시하는 컴포넌트
--}}

@props([
    'items' => [
        [
            'badges' => ['#공용 공간', '#전용 공간'],
            'grayText' => '공유오피스',
            'blackText' => '독립형 오피스 프리미엄',
            'description' => ['전용 오피스와 공용 라운지를 이용하는 합리적인 플랜,', '공유오피스에 프라이빗함을 더하세요'],
            'mainColor' => '#8B7355',
            'subColor' => '#E8DDD4',
            'leftImage' => '/assets/media/area/20/1.png',
            'galleryImages' => ['/assets/media/gallery/1.jpg', '/assets/media/gallery/2.jpg', '/assets/media/gallery/3.jpg'],
            'buttonText' => '더 알아보기',
            'buttonLink' => '#',
            'buttonText2' => null, // 두 번째 버튼 텍스트 (null이면 버튼 1개만 표시)
            'buttonLink2' => '#'
        ],
        [
            'badges' => ['#공용 공간', '#전용 공간', '#30인 이상'],
            'grayText' => '공유오피스 + 사옥',
            'blackText' => '전층형 오피스',
            'description' => ['전용 오피스와 전용 라운지를 이용하는 안심 플랜,', '단독 층 보안으로 안전한 사무실을 만드세요'],
            'mainColor' => '#6B5B95',
            'subColor' => '#D8C4E8',
            'leftImage' => '/assets/media/area/20/1.png',
            'galleryImages' => ['/assets/media/gallery/4.jpg', '/assets/media/gallery/5.jpg', '/assets/media/gallery/6.jpg'],
            'buttonText' => '더 알아보기', 
            'buttonLink' => '#',
            'buttonText2' => null, // 두 번째 버튼 텍스트 (null이면 버튼 1개만 표시)
            'buttonLink2' => '#'
        ]
    ],
    'containerClass' => '',
    'id' => 'gsnt-dos-' . uniqid()
])

<div class="gsnt-dos-container {{ $containerClass }}" id="{{ $id }}">
    <div class="gsnt-dos-wrapper">
        @foreach($items as $index => $item)
            <div class="gsnt-dos-item" data-main-color="{{ $item['mainColor'] }}" data-sub-color="{{ $item['subColor'] }}">
                <!-- 1행: 뱃지들 -->
                <div class="gsnt-dos-badges">
                    @foreach($item['badges'] as $badge)
                        <span class="gsnt-dos-badge" style="background-color: {{ $item['subColor'] }}; color: {{ $item['mainColor'] }};">{{ $badge }}</span>
                    @endforeach
                </div>
                
                <!-- 2행: 회색 텍스트 + 검은 텍스트 -->
                <div class="gsnt-dos-title-row">
                    <span class="gsnt-dos-gray-text">{{ $item['grayText'] }}</span>
                    <span class="gsnt-dos-black-text">{{ $item['blackText'] }}</span>
                </div>
                
                <!-- 3행: 설명 텍스트 2줄 -->
                <div class="gsnt-dos-description">
                    @foreach($item['description'] as $desc)
                        <p>{{ $desc }}</p>
                    @endforeach
                </div>
                
                <!-- 박스 영역 -->
                <div class="gsnt-dos-box">
                    <!-- 좌측 이미지 영역 (33%) -->
                    <div class="gsnt-dos-left-section" style="background-color: {{ $item['mainColor'] }};">
                        <div class="gsnt-dos-image-container">
                            <img src="{{ $item['leftImage'] }}" alt="Office {{ $index + 1 }}" class="gsnt-dos-left-image">
                        </div>
                        
                        <!-- 데스크톱 버튼 (좌측 영역 내부) -->
                        <div class="gsnt-dos-button-wrapper-desktop">
                            @if(isset($item['buttonText2']) && $item['buttonText2'])
                                <!-- 두 개 버튼 -->
                                <a href="{{ $item['buttonLink'] }}" class="gsnt-dos-button gsnt-dos-button-dual">
                                    <span>{{ $item['buttonText'] }}</span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="gsnt-dos-button-icon">
                                        <path d="M6 3L11 8L6 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <a href="{{ $item['buttonLink2'] }}" class="gsnt-dos-button gsnt-dos-button-dual">
                                    <span>{{ $item['buttonText2'] }}</span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="gsnt-dos-button-icon">
                                        <path d="M6 3L11 8L6 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            @else
                                <!-- 한 개 버튼 -->
                                <a href="{{ $item['buttonLink'] }}" class="gsnt-dos-button">
                                    <span>{{ $item['buttonText'] }}</span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="gsnt-dos-button-icon">
                                        <path d="M6 3L11 8L6 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <!-- 우측 갤러리 영역 (67%) -->
                    <div class="gsnt-dos-right-section">
                        <div class="gsnt-dos-gallery-container">
                            @foreach($item['galleryImages'] as $imgIndex => $image)
                                <img src="{{ $image }}" alt="Gallery {{ $index + 1 }} - {{ $imgIndex + 1 }}" 
                                     class="gsnt-dos-gallery-image {{ $imgIndex === 0 ? 'gsnt-dos-active' : '' }}" 
                                     data-slide="{{ $imgIndex }}">
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- 버튼 (박스 아래) -->
                <div class="gsnt-dos-button-wrapper">
                    @if(isset($item['buttonText2']) && $item['buttonText2'])
                        <!-- 두 개 버튼 -->
                        <a href="{{ $item['buttonLink'] }}" class="gsnt-dos-button gsnt-dos-button-dual">
                            <span>{{ $item['buttonText'] }}</span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="gsnt-dos-button-icon">
                                <path d="M6 3L11 8L6 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="{{ $item['buttonLink2'] }}" class="gsnt-dos-button gsnt-dos-button-dual">
                            <span>{{ $item['buttonText2'] }}</span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="gsnt-dos-button-icon">
                                <path d="M6 3L11 8L6 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    @else
                        <!-- 한 개 버튼 -->
                        <a href="{{ $item['buttonLink'] }}" class="gsnt-dos-button">
                            <span>{{ $item['buttonText'] }}</span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="gsnt-dos-button-icon">
                                <path d="M6 3L11 8L6 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    @endif
                </div>
                
                <!-- 인디케이터 -->
                @if(count($item['galleryImages']) > 1)
                    <div class="gsnt-dos-indicators" data-item-index="{{ $index }}">
                        @foreach($item['galleryImages'] as $imgIndex => $image)
                            <div class="gsnt-dos-indicator {{ $imgIndex === 0 ? 'gsnt-dos-indicator-active' : '' }}" 
                                 data-slide="{{ $imgIndex }}" 
                                 style="--main-color: {{ $item['mainColor'] }}"></div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

<style>
.gsnt-dos-container {
    width: 100%;
    max-width: 1380px;
    margin: 0 auto;
    padding: 0 50px;
    box-sizing: border-box;
}

#{{ $id }} .gsnt-dos-wrapper {
    display: grid;
    grid-template-columns: repeat({{ count($items) }}, 1fr);
    gap: 40px;
}

.gsnt-dos-item {
    display: flex;
    flex-direction: column;
}

.gsnt-dos-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 16px;
    justify-content: center;
}

.gsnt-dos-badge {
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;
    white-space: nowrap;
}

.gsnt-dos-title-row {
    margin-bottom: 20px;
    display: flex;
    flex-direction: row;
    align-items: baseline;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
}

.gsnt-dos-gray-text {
    font-size: 28px;
    font-weight: 700;
    color: #AAABAE;
    line-height: 1.2;
}

.gsnt-dos-black-text {
    font-size: 28px;
    font-weight: 700;
    color: #222;
    line-height: 1.2;
}

.gsnt-dos-description {
    margin-bottom: 40px;
    text-align: center;
}

.gsnt-dos-description p {
    font-size: 16px;
    font-weight: 400;
    color: #666;
    line-height: 1.5;
    margin: 0;
}

.gsnt-dos-box {
    width: 100%;
    height: 350px;
    display: flex;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.gsnt-dos-left-section {
    width: 33%;
    position: relative;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.gsnt-dos-image-container {
    flex: 1;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    margin-top: -20px;
}

.gsnt-dos-left-image {
    width: 100%;
    height: auto;
    max-height: 100%;
    object-fit: contain;
}

.gsnt-dos-gallery-container {
    width: 100%;
    height: 100%;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gsnt-dos-gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.gsnt-dos-gallery-image.gsnt-dos-active {
    opacity: 1;
}

.gsnt-dos-button-wrapper {
    display: flex;
    gap: 0;
    margin-top: 20px;
    width: 100%;
    box-sizing: border-box;
}

.gsnt-dos-button {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 16px 12px;
    background-color: #222222;
    color: white !important;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: background-color 0.3s ease;
    box-sizing: border-box;
}

.gsnt-dos-button span {
    color: white !important;
}

.gsnt-dos-button-icon {
    flex-shrink: 0;
    transition: transform 0.2s ease;
}

.gsnt-dos-button-icon path {
    stroke: white !important;
}

.gsnt-dos-button:hover {
    background-color: #333333;
    color: white !important;
    text-decoration: none;
}

.gsnt-dos-button:hover span {
    color: white !important;
}

.gsnt-dos-button:hover .gsnt-dos-button-icon {
    transform: translateX(2px);
}

.gsnt-dos-button:hover .gsnt-dos-button-icon path {
    stroke: white !important;
}

.gsnt-dos-button-dual {
    width: 50% !important;
}

.gsnt-dos-button-wrapper-desktop {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    box-sizing: border-box;
    display: flex;
    gap: 0;
}

/* MD 이상에서 모바일 버튼 숨김 */
@media (min-width: 769px) {
    .gsnt-dos-button-wrapper {
        display: none;
    }
}

/* 모바일에서 데스크톱 버튼 숨김 */
@media (max-width: 768px) {
    .gsnt-dos-button-wrapper-desktop {
        display: none;
    }
}

.gsnt-dos-right-section {
    width: 67%;
    position: relative;
    overflow: hidden;
}

.gsnt-dos-indicators {
    display: flex;
    gap: 0;
    margin-top: 16px;
    justify-content: flex-start;
    height: 4px;
    background-color: #e5e7eb;
    overflow: hidden;
}

.gsnt-dos-indicator {
    flex: 1;
    height: 4px;
    background-color: #e5e7eb;
    cursor: pointer;
    transition: background-color 0.3s ease;
    border: none;
}

.gsnt-dos-indicator.gsnt-dos-indicator-active {
    background-color: var(--main-color);
}

/* Tablet */
@media (max-width: 1024px) {
    .gsnt-dos-container {
        padding: 0 30px;
    }
    
    .gsnt-dos-wrapper {
        gap: 30px;
    }
    
    .gsnt-dos-box {
        height: 300px;
    }
}

/* Mobile */
@media (max-width: 768px) {
    .gsnt-dos-container {
        padding: 0 20px;
    }
    
    .gsnt-dos-wrapper {
        grid-template-columns: 1fr !important;
        gap: 40px;
    }
    
    .gsnt-dos-box {
        height: 220px;
    }
    
    .gsnt-dos-left-section {
        width: 33%;
    }
    
    .gsnt-dos-right-section {
        width: 67%;
    }
    
    .gsnt-dos-button-wrapper {
        flex-direction: column;
        gap: 10px;
    }
    
    .gsnt-dos-button-dual {
        width: 100% !important;
    }
    
    .gsnt-dos-image-container {
        margin-top: 0;
    }
    
    .gsnt-dos-black-text {
        font-size: 28px;
    }
    
    .gsnt-dos-description p {
        font-size: 14px;
    }
    
    .gsnt-dos-badge {
        font-size: 12px;
        padding: 4px 10px;
    }
    
    .gsnt-dos-button {
        font-size: 12px !important;
        padding: 12px 8px !important;
    }
}

@media (max-width: 480px) {
    .gsnt-dos-container {
        padding: 0 16px;
    }
    
    .gsnt-dos-black-text {
        font-size: 24px;
    }
    
    .gsnt-dos-description p {
        font-size: 13px;
    }
    
    .gsnt-dos-badge {
        font-size: 11px;
        padding: 3px 8px;
    }
    
    .gsnt-dos-button {
        font-size: 11px !important;
        padding: 10px 6px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const containerId = '{{ $id }}';
    const container = document.getElementById(containerId);
    if (!container) return;

    const items = container.querySelectorAll('.gsnt-dos-item');
    
    items.forEach((item, itemIndex) => {
        const images = item.querySelectorAll('.gsnt-dos-gallery-image');
        const indicators = item.querySelectorAll('.gsnt-dos-indicator');
        
        if (images.length <= 1) return;
        
        let currentSlide = 0;
        
        function updateSlide(index) {
            // Update images
            images.forEach((img, i) => {
                if (i === index) {
                    img.classList.add('gsnt-dos-active');
                } else {
                    img.classList.remove('gsnt-dos-active');
                }
            });
            
            // Update indicators
            indicators.forEach((indicator, i) => {
                if (i === index) {
                    indicator.classList.add('gsnt-dos-indicator-active');
                } else {
                    indicator.classList.remove('gsnt-dos-indicator-active');
                }
            });
            
            currentSlide = index;
        }
        
        // Indicator click handlers
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                updateSlide(index);
            });
        });
        
        // Auto-play
        let autoPlayInterval = setInterval(() => {
            const nextSlide = (currentSlide + 1) % images.length;
            updateSlide(nextSlide);
        }, 4000);
        
        // Pause on hover
        item.addEventListener('mouseenter', () => {
            clearInterval(autoPlayInterval);
        });
        
        item.addEventListener('mouseleave', () => {
            autoPlayInterval = setInterval(() => {
                const nextSlide = (currentSlide + 1) % images.length;
                updateSlide(nextSlide);
            }, 4000);
        });
        
        // Touch/Swipe support for mobile
        const rightSection = item.querySelector('.gsnt-dos-right-section');
        let touchStartX = 0;
        let touchEndX = 0;
        
        rightSection.addEventListener('touchstart', (e) => {
            touchStartX = e.touches[0].clientX;
            clearInterval(autoPlayInterval);
        });
        
        rightSection.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].clientX;
            const deltaX = touchEndX - touchStartX;
            
            if (Math.abs(deltaX) > 50) {
                if (deltaX > 0) {
                    // Swipe right - previous
                    const prevSlide = (currentSlide - 1 + images.length) % images.length;
                    updateSlide(prevSlide);
                } else {
                    // Swipe left - next
                    const nextSlide = (currentSlide + 1) % images.length;
                    updateSlide(nextSlide);
                }
            }
            
            // Restart auto-play
            setTimeout(() => {
                autoPlayInterval = setInterval(() => {
                    const nextSlide = (currentSlide + 1) % images.length;
                    updateSlide(nextSlide);
                }, 4000);
            }, 1000);
        });
    });
});
</script>