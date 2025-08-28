{{--
    Hero Slider Banner Component
    전체 넓이 슬라이더 배너 컴포넌트
--}}

@props([
    'slides' => [
        [
            'badge' => '이벤트',
            'badgeColor' => '#FF6B35',
            'title' => '공실앤톡과 함께<br>스마트한 오피스 솔루션',
            'description' => '맞춤형 설계부터 가구 세팅까지, 원스톱 오피스 서비스를 경험해보세요',
            'backgroundImage' => '/assets/media/s_3.png',
            'buttonText' => '자세히 보기',
            'buttonLink' => '#'
        ],
        [
            'badge' => 'HOT',
            'badgeColor' => '#DC3545',
            'title' => '초기비용 0원<br>프리미엄 오피스',
            'description' => '보증금부터 인테리어까지 모든 비용 부담 없이 바로 입주 가능한 오피스',
            'backgroundImage' => '/assets/media/s_3.png',
            'buttonText' => '무료 견적받기',
            'buttonLink' => '#'
        ],
        [
            'badge' => 'NEW',
            'badgeColor' => '#28A745',
            'title' => '당일 입주 가능<br>맞춤형 사무공간',
            'description' => '상담부터 입주까지 단 하루! 기업 맞춤형 사무공간 설계 서비스',
            'backgroundImage' => '/assets/media/s_3.png',
            'buttonText' => '상담 신청하기',
            'buttonLink' => '#'
        ]
    ],
    'height' => '490px',
    'mobileHeight' => '550px',
    'containerClass' => '',
    'id' => 'gsnt-hero-slider-' . uniqid()
])

<div class="gsnt-hs-container {{ $containerClass }}" id="{{ $id }}">
    <div class="gsnt-hs-slider-wrapper">
        @foreach($slides as $index => $slide)
            <div class="gsnt-hs-slide {{ $index === 0 ? 'gsnt-hs-active' : '' }}" 
                 style="background-image: url('{{ $slide['backgroundImage'] }}');"
                 data-slide="{{ $index }}">
                
                <div class="gsnt-hs-content-wrapper">
                    <div class="gsnt-hs-content">
                        <!-- Badge -->
                        @if(isset($slide['badge']) && $slide['badge'])
                            <div class="gsnt-hs-badge" style="background-color: {{ $slide['badgeColor'] ?? '#FF6B35' }}">
                                {{ $slide['badge'] }}
                            </div>
                        @endif
                        
                        <!-- Main Title -->
                        <h1 class="gsnt-hs-title">{!! $slide['title'] !!}</h1>
                        
                        <!-- Description -->
                        <p class="gsnt-hs-description">{{ $slide['description'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    @if(count($slides) > 1)
        <div class="gsnt-hs-nav-controls">
            <!-- Progress Indicator -->
            <div class="gsnt-hs-progress-bar">
                <div class="gsnt-hs-progress-fill" data-slides="{{ count($slides) }}"></div>
            </div>
            
            <!-- Navigation Controls -->
            <div class="gsnt-hs-control-buttons">
                <button class="gsnt-hs-nav-btn gsnt-hs-prev" aria-label="이전 슬라이드">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="gsnt-hs-slide-counter">
                    <span class="gsnt-hs-current-number">1</span>
                    <span class="gsnt-hs-separator">/</span>
                    <span class="gsnt-hs-total-number">{{ count($slides) }}</span>
                </div>
                <button class="gsnt-hs-nav-btn gsnt-hs-next" aria-label="다음 슬라이드">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif
</div>

<style>
.gsnt-hs-container {
    width: 100%;
    position: relative;
    overflow: hidden;
}

.gsnt-hs-slider-wrapper {
    position: relative;
    width: 100%;
    height: {{ $height }};
}

.gsnt-hs-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: 0;
    transition: opacity 0.6s ease-in-out;
    display: flex;
    align-items: center;
}

.gsnt-hs-slide.gsnt-hs-active {
    opacity: 1;
}

.gsnt-hs-content-wrapper {
    width: 100%;
    max-width: 1380px;
    margin: 0 auto;
    padding: 0 50px;
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    height: 100%;
}

.gsnt-hs-content {
    text-align: left;
    color: white;
    max-width: 600px;
    padding-bottom: 80px;
}

.gsnt-hs-badge {
    display: inline-block;
    padding: 4px 20px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    color: white;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.gsnt-hs-title {
    font-size: 48px;
    font-weight: 800;
    color: white;
    line-height: 1.2;
    margin: 0 0 24px 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.gsnt-hs-description {
    font-size: 18px;
    font-weight: 400;
    color: white;
    line-height: 1.6;
    margin: 0 0 40px 0;
    opacity: 0.95;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}


.gsnt-hs-nav-controls {
    position: absolute;
    bottom: 100px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 16px;
    z-index: 10;
    max-width: 1480px;
    width: 100%;
    padding: 0 50px;
    box-sizing: border-box;
}

.gsnt-hs-progress-bar {
    width: min(360px, calc(100vw - 100px));
    height: 4px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 2px;
    overflow: hidden;
}

.gsnt-hs-progress-fill {
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 2px;
    transition: width 0.4s ease;
    width: 33.33%;
}

.gsnt-hs-control-buttons {
    display: flex;
    align-items: center;
    gap: 16px;
}

.gsnt-hs-slide-counter {
    display: flex;
    align-items: center;
    gap: 4px;
    color: white;
    font-size: 16px;
    font-weight: 600;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    min-width: 40px;
    justify-content: center;
}

.gsnt-hs-current-number {
    font-size: 18px;
}

.gsnt-hs-separator {
    opacity: 0.7;
    margin: 0 2px;
}

.gsnt-hs-total-number {
    opacity: 0.7;
    font-size: 16px;
}

.gsnt-hs-nav-btn {
    width: 48px;
    height: 48px;
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.gsnt-hs-nav-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
}

.gsnt-hs-nav-btn:active {
    transform: translateY(0);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .gsnt-hs-slider-wrapper {
        height: {{ $mobileHeight }};
    }
    
    .gsnt-hs-content-wrapper {
        padding: 0 20px;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        gap: 40px;
    }
    
    .gsnt-hs-title {
        font-size: 36px;
        margin-bottom: 16px;
    }
    
    .gsnt-hs-description {
        font-size: 16px;
        margin-bottom: 32px;
    }
    
    .gsnt-hs-nav-controls {
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        gap: 12px;
        max-width: 100%;
        padding: 0 20px;
    }
    
    .gsnt-hs-progress-bar {
        width: min(300px, calc(100vw - 40px));
        height: 3px;
    }
    
    .gsnt-hs-control-buttons {
        gap: 12px;
    }
    
    .gsnt-hs-slide-counter {
        font-size: 14px;
    }
    
    .gsnt-hs-current-number {
        font-size: 16px;
    }
}

@media (max-width: 480px) {
    .gsnt-hs-content-wrapper {
        padding: 0 16px;
        gap: 30px;
    }
    
    .gsnt-hs-title {
        font-size: 28px;
    }
    
    .gsnt-hs-description {
        font-size: 14px;
    }
    
    .gsnt-hs-badge {
        font-size: 12px;
        padding: 6px 16px;
    }
    
    .gsnt-hs-nav-btn {
        width: 40px;
        height: 40px;
    }
    
    .gsnt-hs-nav-controls {
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        gap: 10px;
        max-width: 100%;
        padding: 0 16px;
    }
    
    .gsnt-hs-progress-bar {
        width: min(240px, calc(100vw - 32px));
        height: 3px;
    }
    
    .gsnt-hs-control-buttons {
        gap: 10px;
    }
    
    .gsnt-hs-slide-counter {
        font-size: 13px;
        min-width: 35px;
    }
    
    .gsnt-hs-current-number {
        font-size: 15px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sliderId = '{{ $id }}';
    const container = document.getElementById(sliderId);
    if (!container) {
        console.warn('Slider container not found:', sliderId);
        return;
    }
    
    let currentSlide = 0;
    const totalSlides = container.querySelectorAll('.gsnt-hs-slide').length;
    
    if (totalSlides <= 1) return;
    
    console.log('Hero slider initialized with', totalSlides, 'slides');
    
    function updateSlide(index) {
        console.log('Updating to slide:', index + 1);
        
        // Update slides only
        container.querySelectorAll('.gsnt-hs-slide').forEach((slide, i) => {
            if (i === index) {
                slide.classList.add('gsnt-hs-active');
            } else {
                slide.classList.remove('gsnt-hs-active');
            }
        });
        
        // Update slide counter
        const currentNumberSpan = container.querySelector('.gsnt-hs-current-number');
        if (currentNumberSpan) {
            currentNumberSpan.textContent = (index + 1);
            console.log('Updated slide counter to:', index + 1);
        }
        
        // Update progress bar
        const progressFill = container.querySelector('.gsnt-hs-progress-fill');
        if (progressFill) {
            const percentage = ((index + 1) / totalSlides) * 100;
            progressFill.style.width = percentage + '%';
            console.log('Updated progress bar to:', percentage + '%');
        }
        
        currentSlide = index;
    }
    
    function nextSlide() {
        const next = (currentSlide + 1) % totalSlides;
        updateSlide(next);
    }
    
    function prevSlide() {
        const prev = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlide(prev);
    }
    
    // Initialize first slide
    updateSlide(0);
    
    // Event listeners with more robust approach
    setTimeout(() => {
        // Try multiple approaches to find buttons
        let nextBtn = container.querySelector('.gsnt-hs-next');
        let prevBtn = container.querySelector('.gsnt-hs-prev');
        
        // If not found, try global search
        if (!nextBtn) {
            nextBtn = document.querySelector(`#${sliderId} .gsnt-hs-next`);
        }
        if (!prevBtn) {
            prevBtn = document.querySelector(`#${sliderId} .gsnt-hs-prev`);
        }
        
        console.log('Button search results:');
        console.log('- Next button found:', !!nextBtn);
        console.log('- Prev button found:', !!prevBtn);
        
        // Add click handlers
        if (nextBtn) {
            nextBtn.onclick = function() {
                console.log('Next button clicked!');
                nextSlide();
            };
            console.log('Next button handler set');
        } else {
            console.warn('Next button not found!');
        }
        
        if (prevBtn) {
            prevBtn.onclick = function() {
                console.log('Prev button clicked!');
                prevSlide();
            };
            console.log('Prev button handler set');
        } else {
            console.warn('Prev button not found!');
        }
        
        // Debug: show all elements in container
        console.log('All elements in container:', container.querySelectorAll('*').length);
        
    }, 200);
    
    // Touch/Swipe functionality
    const sliderWrapper = container.querySelector('.gsnt-hs-slider-wrapper');
    if (sliderWrapper) {
        let touchStartX = 0;
        let touchEndX = 0;
        
        sliderWrapper.addEventListener('touchstart', (e) => {
            touchStartX = e.touches[0].clientX;
            stopAutoPlay();
        });
        
        sliderWrapper.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].clientX;
            const deltaX = touchEndX - touchStartX;
            
            if (Math.abs(deltaX) > 50) {
                if (deltaX > 0) {
                    prevSlide();
                } else {
                    nextSlide();
                }
            }
            
            setTimeout(startAutoPlay, 1000);
        });
    }
    
    // Auto-play
    let autoPlayInterval;
    
    function startAutoPlay() {
        clearInterval(autoPlayInterval);
        autoPlayInterval = setInterval(nextSlide, 5000);
    }
    
    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }
    
    // Start auto-play
    setTimeout(startAutoPlay, 1000);
    
    // Pause on hover
    container.addEventListener('mouseenter', stopAutoPlay);
    container.addEventListener('mouseleave', startAutoPlay);
    
    // Keyboard navigation
    container.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            e.preventDefault();
            prevSlide();
        } else if (e.key === 'ArrowRight') {
            e.preventDefault();
            nextSlide();
        }
    });
    
    container.setAttribute('tabindex', '0');
});
</script>