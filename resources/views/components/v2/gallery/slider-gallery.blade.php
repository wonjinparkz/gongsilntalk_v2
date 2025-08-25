{{--
    Slider Gallery Component
    탭 없이 슬라이드 기능이 있는 이미지 갤러리
    각 슬라이드는 좌우 50%로 이미지 표시
    기본적으로 /assets/media/gallery 경로의 이미지를 자동으로 사용
--}}

@props([
    'images' => [], // [['left' => 'path', 'right' => 'path'], ...]
    'autoLoadImages' => true, // gallery 폴더에서 이미지 자동 로드
    'height' => '600px',
    'autoPlay' => false,
    'autoPlayInterval' => 5000,
    'showIndicators' => true,
    'showArrows' => true,
    'containerClass' => '',
])

@php
    // Generate unique ID for this gallery instance
    $galleryId = 'gallery-' . uniqid();
    
    // images가 비어있고 autoLoadImages가 true인 경우 gallery 폴더에서 이미지 자동 로드
    if (empty($images) && $autoLoadImages) {
        $galleryPath = public_path('assets/media/gallery');
        $imageFiles = [];
        
        if (file_exists($galleryPath)) {
            $files = scandir($galleryPath);
            foreach ($files as $file) {
                if (preg_match('/^(\d+)\.(jpg|jpeg|png|gif)$/i', $file, $matches)) {
                    $imageFiles[] = [
                        'number' => intval($matches[1]),
                        'file' => $file
                    ];
                }
            }
            
            // 번호 순으로 정렬
            usort($imageFiles, function($a, $b) {
                return $a['number'] - $b['number'];
            });
            
            // 이미지 배열 생성 (홀수-짝수 쌍으로 구성)
            $images = [];
            for ($i = 0; $i < count($imageFiles); $i += 2) {
                $leftImage = "/assets/media/gallery/" . $imageFiles[$i]['file'];
                
                // 다음 이미지가 있으면 우측에 사용, 없으면 같은 이미지 사용
                $rightImage = isset($imageFiles[$i + 1]) 
                    ? "/assets/media/gallery/" . $imageFiles[$i + 1]['file']
                    : $leftImage;
                
                $images[] = [
                    'left' => $leftImage,
                    'right' => $rightImage
                ];
            }
        }
        
        // 이미지가 없는 경우 기본 플레이스홀더 사용
        if (empty($images)) {
            $images = [['left' => '/assets/media/placeholder.jpg', 'right' => '/assets/media/placeholder.jpg']];
        }
    }
@endphp

<div class="slider-gallery-container {{ $containerClass }}" id="{{ $galleryId }}">
    <div class="slider-gallery-wrapper" style="height: {{ $height }};">
        <div class="slider-gallery-track">
            @forelse($images as $index => $image)
                <div class="slider-gallery-slide {{ $index === 0 ? 'active' : '' }}">
                    <div class="slider-gallery-images">
                        <div class="slider-gallery-left">
                            <img src="{{ $image['left'] ?? '/assets/media/placeholder.jpg' }}" 
                                 alt="이미지 {{ $index + 1 }} - 좌측"
                                 onerror="this.src='/assets/media/placeholder.jpg'">
                        </div>
                        <div class="slider-gallery-right">
                            <img src="{{ $image['right'] ?? $image['left'] ?? '/assets/media/placeholder.jpg' }}" 
                                 alt="이미지 {{ $index + 1 }} - 우측"
                                 onerror="this.src='/assets/media/placeholder.jpg'">
                        </div>
                    </div>
                </div>
            @empty
                <div class="slider-gallery-slide active">
                    <div class="slider-gallery-images">
                        <div class="slider-gallery-left">
                            <img src="/assets/media/placeholder.jpg" alt="기본 이미지">
                        </div>
                        <div class="slider-gallery-right">
                            <img src="/assets/media/placeholder.jpg" alt="기본 이미지">
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        @if($showArrows && count($images) > 1)
            <button class="slider-arrow slider-arrow-prev" onclick="changeSliderImage('{{ $galleryId }}', -1)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="slider-arrow slider-arrow-next" onclick="changeSliderImage('{{ $galleryId }}', 1)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        @endif

        @if($showIndicators && count($images) > 1)
            <div class="slider-indicators">
                @foreach($images as $index => $image)
                    <button 
                        class="slider-indicator {{ $index === 0 ? 'active' : '' }}" 
                        onclick="goToSliderImage('{{ $galleryId }}', {{ $index }})"
                        aria-label="이미지 {{ $index + 1 }}"
                    ></button>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
.slider-gallery-container {
    width: 100%;
    position: relative;
}

.slider-gallery-wrapper {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #f5f5f5;
}

.slider-gallery-track {
    position: relative;
    width: 100%;
    height: 100%;
}

.slider-gallery-slide {
    display: none;
    width: 100%;
    height: 100%;
}

.slider-gallery-slide.active {
    display: block;
}

.slider-gallery-images {
    display: flex;
    width: 100%;
    height: 100%;
    gap: 0;
}

.slider-gallery-left,
.slider-gallery-right {
    width: 50%;
    height: 100%;
    overflow: hidden;
    position: relative;
}

.slider-gallery-left img,
.slider-gallery-right img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Navigation Arrows */
.slider-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 48px;
    height: 48px;
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid #e5e5e5;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
}

.slider-arrow:hover {
    background: #fff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.slider-arrow-prev {
    left: 20px;
}

.slider-arrow-next {
    right: 20px;
}

.slider-arrow svg {
    width: 24px;
    height: 24px;
    color: #222;
}

/* Indicators */
.slider-indicators {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
}

.slider-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    border: 1px solid rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition: all 0.3s ease;
}

.slider-indicator.active {
    background: #fff;
    width: 24px;
    border-radius: 4px;
}

.slider-indicator:hover {
    background: rgba(255, 255, 255, 0.8);
}

/* Responsive */
@media (max-width: 768px) {
    .slider-gallery-wrapper {
        height: 400px !important;
    }
    
    .slider-gallery-images {
        flex-direction: column;
    }
    
    .slider-gallery-left,
    .slider-gallery-right {
        width: 100%;
        height: 50%;
    }
    
    .slider-arrow {
        width: 40px;
        height: 40px;
    }
    
    .slider-arrow-prev {
        left: 10px;
    }
    
    .slider-arrow-next {
        right: 10px;
    }
}

@media (max-width: 480px) {
    .slider-gallery-wrapper {
        height: 300px !important;
    }
}
</style>

<script>
// Gallery state management
window.sliderGalleries = window.sliderGalleries || {};

function initSliderGallery(galleryId) {
    if (!window.sliderGalleries[galleryId]) {
        window.sliderGalleries[galleryId] = {
            currentIndex: 0
        };
    }
}

function changeSliderImage(galleryId, direction) {
    initSliderGallery(galleryId);
    
    const gallery = document.getElementById(galleryId);
    const slides = gallery.querySelectorAll('.slider-gallery-slide');
    const indicators = gallery.querySelectorAll('.slider-indicator');
    
    if (slides.length === 0) return;
    
    // Hide current slide
    slides[window.sliderGalleries[galleryId].currentIndex].classList.remove('active');
    if (indicators.length > 0) {
        indicators[window.sliderGalleries[galleryId].currentIndex].classList.remove('active');
    }
    
    // Calculate new index
    window.sliderGalleries[galleryId].currentIndex += direction;
    
    // Wrap around
    if (window.sliderGalleries[galleryId].currentIndex < 0) {
        window.sliderGalleries[galleryId].currentIndex = slides.length - 1;
    } else if (window.sliderGalleries[galleryId].currentIndex >= slides.length) {
        window.sliderGalleries[galleryId].currentIndex = 0;
    }
    
    // Show new slide
    slides[window.sliderGalleries[galleryId].currentIndex].classList.add('active');
    if (indicators.length > 0) {
        indicators[window.sliderGalleries[galleryId].currentIndex].classList.add('active');
    }
}

function goToSliderImage(galleryId, index) {
    initSliderGallery(galleryId);
    
    const gallery = document.getElementById(galleryId);
    const slides = gallery.querySelectorAll('.slider-gallery-slide');
    const indicators = gallery.querySelectorAll('.slider-indicator');
    
    if (slides.length === 0 || index >= slides.length) return;
    
    // Hide current slide
    slides[window.sliderGalleries[galleryId].currentIndex].classList.remove('active');
    if (indicators.length > 0) {
        indicators[window.sliderGalleries[galleryId].currentIndex].classList.remove('active');
    }
    
    // Update index
    window.sliderGalleries[galleryId].currentIndex = index;
    
    // Show new slide
    slides[window.sliderGalleries[galleryId].currentIndex].classList.add('active');
    if (indicators.length > 0) {
        indicators[window.sliderGalleries[galleryId].currentIndex].classList.add('active');
    }
}

// Auto-play functionality
@if($autoPlay)
document.addEventListener('DOMContentLoaded', function() {
    setInterval(function() {
        changeSliderImage('{{ $galleryId }}', 1);
    }, {{ $autoPlayInterval }});
});
@endif
</script>