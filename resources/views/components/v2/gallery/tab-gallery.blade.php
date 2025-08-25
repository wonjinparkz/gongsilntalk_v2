{{--
    Tab Gallery Component
    각 평수별 이미지를 탭으로 전환하여 보여주는 갤러리
--}}

@props([
    'areas' => [
        ['size' => '10', 'label' => '10평'],
        ['size' => '20', 'label' => '20평'],
        ['size' => '30', 'label' => '30평'],
        ['size' => '50', 'label' => '50평'],
        ['size' => '100', 'label' => '100평'],
    ]
])

<div class="tab-gallery-container">
    {{-- Tab Buttons --}}
    <div class="tab-buttons-container">
        @foreach($areas as $index => $area)
            <button 
                class="tab-button {{ $index === 0 ? 'active' : '' }}" 
                data-tab="{{ $area['size'] }}"
                onclick="switchTab('{{ $area['size'] }}')"
            >
                {{ $area['label'] }}
            </button>
        @endforeach
    </div>

    {{-- Gallery Content --}}
    <div class="gallery-content">
        @foreach($areas as $index => $area)
            <div class="gallery-tab-content {{ $index === 0 ? 'active' : '' }}" data-content="{{ $area['size'] }}">
                <div class="gallery-slider">
                    <div class="gallery-track">
                        {{-- Check for multiple images in the directory --}}
                        @php
                            $imagePath = public_path("assets/media/area/{$area['size']}");
                            $images = [];
                            if (file_exists($imagePath)) {
                                $files = scandir($imagePath);
                                foreach ($files as $file) {
                                    if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
                                        $images[] = $file;
                                    }
                                }
                                sort($images);
                            }
                            // If no images found, use placeholder
                            if (empty($images)) {
                                $images = ['1.jpg', '2.jpg'];
                            }
                        @endphp

                        @foreach($images as $slideIndex => $image)
                            <div class="gallery-slide {{ $slideIndex === 0 ? 'active' : '' }}">
                                <div class="gallery-image-container">
                                    <div class="gallery-image-left">
                                        <img src="/assets/media/area/{{ $area['size'] }}/{{ $image }}" 
                                             alt="{{ $area['label'] }} 이미지 {{ $slideIndex + 1 }}"
                                             onerror="this.src='/assets/media/placeholder.jpg'">
                                    </div>
                                    <div class="gallery-image-right">
                                        <img src="/assets/media/area/{{ $area['size'] }}/{{ $image }}" 
                                             alt="{{ $area['label'] }} 이미지 {{ $slideIndex + 1 }}"
                                             onerror="this.src='/assets/media/placeholder.jpg'">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Navigation Arrows (show only if more than 1 image) --}}
                    @if(count($images) > 1)
                        <button class="gallery-nav gallery-nav-prev" onclick="changeSlide('{{ $area['size'] }}', -1)">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button class="gallery-nav gallery-nav-next" onclick="changeSlide('{{ $area['size'] }}', 1)">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        {{-- Slide Indicators --}}
                        <div class="gallery-indicators">
                            @foreach($images as $indicatorIndex => $img)
                                <button 
                                    class="gallery-indicator {{ $indicatorIndex === 0 ? 'active' : '' }}" 
                                    onclick="goToSlide('{{ $area['size'] }}', {{ $indicatorIndex }})"
                                ></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.tab-gallery-container {
    width: 100%;
    margin: 0 auto;
}

/* Tab Buttons */
.tab-buttons-container {
    display: flex;
    gap: 16px;
    justify-content: center;
    align-items: center;
    margin: 0 0 32px;
    flex-wrap: wrap;
}

.tab-button {
    width: 128px;
    padding: 6px 32px;
    text-align: center;
    font-size: 16px;
    font-weight: 700;
    color: #aaa;
    background: #fff;
    border-radius: 56px;
    cursor: pointer;
    border: 1px solid #e5e5e5;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.tab-button:hover {
    border-color: #222;
}

.tab-button.active {
    background: #222;
    color: #fff;
    border-color: #222;
}

/* Gallery Content */
.gallery-content {
    width: 100%;
    position: relative;
}

.gallery-tab-content {
    display: none;
    width: 100%;
}

.gallery-tab-content.active {
    display: block;
}

/* Gallery Slider */
.gallery-slider {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.gallery-track {
    position: relative;
    width: 100%;
}

.gallery-slide {
    display: none;
    width: 100%;
}

.gallery-slide.active {
    display: block;
}

/* Image Container */
.gallery-image-container {
    display: flex;
    width: 100%;
    height: 600px;
    gap: 0;
}

.gallery-image-left,
.gallery-image-right {
    width: 50%;
    height: 100%;
    overflow: hidden;
}

.gallery-image-left img,
.gallery-image-right img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Navigation Arrows */
.gallery-nav {
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

.gallery-nav:hover {
    background: #fff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.gallery-nav-prev {
    left: 20px;
}

.gallery-nav-next {
    right: 20px;
}

.gallery-nav svg {
    width: 24px;
    height: 24px;
    color: #222;
}

/* Slide Indicators */
.gallery-indicators {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
}

.gallery-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    border: 1px solid rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition: all 0.3s ease;
}

.gallery-indicator.active {
    background: #fff;
    width: 24px;
    border-radius: 4px;
}

/* Responsive */
@media (max-width: 768px) {
    .tab-buttons-container {
        margin: 40px 0 24px;
        gap: 8px;
    }

    .tab-button {
        width: auto;
        padding: 6px 20px;
        font-size: 14px;
    }

    .gallery-image-container {
        height: 400px;
        flex-direction: column;
    }

    .gallery-image-left,
    .gallery-image-right {
        width: 100%;
        height: 50%;
    }

    .gallery-nav {
        width: 40px;
        height: 40px;
    }

    .gallery-nav-prev {
        left: 10px;
    }

    .gallery-nav-next {
        right: 10px;
    }
}

@media (max-width: 480px) {
    .gallery-image-container {
        height: 300px;
    }
}
</style>

<script>
// Current slide index for each tab
let currentSlides = {
    '10': 0,
    '20': 0,
    '30': 0,
    '50': 0,
    '100': 0
};

// Switch tabs
function switchTab(tabSize) {
    // Update tab buttons
    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('active');
        if (btn.dataset.tab === tabSize) {
            btn.classList.add('active');
        }
    });

    // Update tab content
    document.querySelectorAll('.gallery-tab-content').forEach(content => {
        content.classList.remove('active');
        if (content.dataset.content === tabSize) {
            content.classList.add('active');
        }
    });
}

// Change slide
function changeSlide(tabSize, direction) {
    const content = document.querySelector(`.gallery-tab-content[data-content="${tabSize}"]`);
    const slides = content.querySelectorAll('.gallery-slide');
    const indicators = content.querySelectorAll('.gallery-indicator');
    
    if (slides.length === 0) return;

    // Hide current slide
    slides[currentSlides[tabSize]].classList.remove('active');
    if (indicators.length > 0) {
        indicators[currentSlides[tabSize]].classList.remove('active');
    }

    // Calculate new index
    currentSlides[tabSize] += direction;
    
    // Wrap around
    if (currentSlides[tabSize] < 0) {
        currentSlides[tabSize] = slides.length - 1;
    } else if (currentSlides[tabSize] >= slides.length) {
        currentSlides[tabSize] = 0;
    }

    // Show new slide
    slides[currentSlides[tabSize]].classList.add('active');
    if (indicators.length > 0) {
        indicators[currentSlides[tabSize]].classList.add('active');
    }
}

// Go to specific slide
function goToSlide(tabSize, index) {
    const content = document.querySelector(`.gallery-tab-content[data-content="${tabSize}"]`);
    const slides = content.querySelectorAll('.gallery-slide');
    const indicators = content.querySelectorAll('.gallery-indicator');
    
    if (slides.length === 0 || index >= slides.length) return;

    // Hide current slide
    slides[currentSlides[tabSize]].classList.remove('active');
    if (indicators.length > 0) {
        indicators[currentSlides[tabSize]].classList.remove('active');
    }

    // Update index
    currentSlides[tabSize] = index;

    // Show new slide
    slides[currentSlides[tabSize]].classList.add('active');
    if (indicators.length > 0) {
        indicators[currentSlides[tabSize]].classList.add('active');
    }
}

// Auto-play functionality (optional)
function startAutoPlay(tabSize, interval = 5000) {
    setInterval(() => {
        const content = document.querySelector(`.gallery-tab-content[data-content="${tabSize}"]`);
        if (content && content.classList.contains('active')) {
            changeSlide(tabSize, 1);
        }
    }, interval);
}

// Initialize autoplay for active tab (optional)
// document.addEventListener('DOMContentLoaded', () => {
//     startAutoPlay('10');
// });
</script>