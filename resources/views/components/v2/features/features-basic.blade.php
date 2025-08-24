@props([
    'subtitle1' => '부동산에서 찾기 어려운',
    'subtitle2' => '역세권 사무실',
    'title' => '효율적인 부동산 관리 솔루션',
    'description1' => '점점 공실 찾기 어려운 강남은 물론,',
    'description2' => '부동산에서 잘 안 보여주는',
    'description3' => '진짜 초역세권 사무실을 확인하세요.',
    'image' => '/assets/media/s_map.png',
    'imageAlt' => '공실앤톡 대시보드',
    'imagePosition' => 'left', // 'left' or 'right'
    'enableStrikethrough' => true,
    'containerClass' => '',
    'id' => 'features-' . uniqid()
])

<div class="features-basic-container {{ $containerClass }} image-{{ $imagePosition }}" id="{{ $id }}">
    <div class="features-basic-content {{ $imagePosition === 'left' ? 'image-left' : 'image-right' }}">
        @if($imagePosition === 'left')
            <div class="features-image-section">
                <div class="features-image-wrapper">
                    <img src="{{ $image }}" alt="{{ $imageAlt }}" class="features-image">
                    <div class="features-image-decoration"></div>
                </div>
            </div>
        @endif
        
        <div class="features-text-section">
            <div class="features-header">
                <div class="features-subtitle-wrapper">
                    <div class="features-subtitle-line" @if($enableStrikethrough) data-scroll-animation="line1" @endif>
                        <span class="text-wrapper">
                            {{ $subtitle1 }}
                            @if($enableStrikethrough)
                                <span class="strikethrough-line"></span>
                            @endif
                        </span>
                    </div>
                    <div class="features-subtitle-line" @if($enableStrikethrough) data-scroll-animation="line2" @endif>
                        <span class="text-wrapper">
                            {{ $subtitle2 }}
                            @if($enableStrikethrough)
                                <span class="strikethrough-line"></span>
                            @endif
                        </span>
                    </div>
                </div>
                <h2 class="features-title">
                    {{ $title }}
                </h2>
                <p class="body-t-xl">
                    {{ $description1 }}<br>
                    {{ $description2 }}<br>
                    {{ $description3 }}
                </p>
            </div>
        </div>
        
        @if($imagePosition === 'right')
            <div class="features-image-section">
                <div class="features-image-wrapper">
                    <img src="{{ $image }}" alt="{{ $imageAlt }}" class="features-image">
                    <div class="features-image-decoration"></div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.features-basic-container {
    width: 100%;
    padding: 80px 20px;
    background: linear-gradient(180deg, #FAFAFA 0%, #FFFFFF 100%);
    overflow: hidden;
}

.features-basic-content {
    max-width: 1080px;
    margin: 0 auto;
    display: flex;
    gap: 40px;
}

.features-text-section {
    flex: 4.5;
}

/* Image Left Layout */
.features-basic-content.image-left .features-text-section {
    padding-left: 20px;
    padding-right: 0;
}

.features-basic-content.image-left .features-header {
    text-align: left;
}

/* Image Right Layout (default) */
.features-basic-content.image-right .features-text-section {
    padding-right: 20px;
    padding-left: 0;
}

.features-basic-content.image-right .features-header {
    text-align: left;
}

.features-header {
    position: relative;
}

.features-subtitle-wrapper {
  margin-bottom: 0;
}

.features-subtitle-line {
  display: block;
  line-height: 1.4;
}

.features-subtitle-line .text-wrapper {
  position: relative;
  display: inline-block;
  font-size: 34px !important;
  font-weight: 500 !important;
  letter-spacing: -1px;
  color: #aaa !important;
}

.strikethrough-line {
    position: absolute;
    top: 50%;
    left: 0;
    width: 0;
    height: 3px;
    background: var(--primary-color);
    transform: translateY(-50%);
    transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    transform-origin: left center;
}

.features-subtitle-line.strikethrough-active .strikethrough-line {
    width: 100%;
}

.features-subtitle-line.strikethrough-reverse .strikethrough-line {
    transform-origin: right center;
    left: auto;
    right: 0;
}

.features-title {
    font-size: 36px !important;
    font-weight: 700 !important;
    line-height: 1.4;
    color: #1F1F1F !important;
    margin: 20px 0 24px;
}

.features-image-section {
    flex: 5.5;
    position: relative;
}

.features-image-wrapper {
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
}

.features-image {
    width: 100%;
    height: auto;
    display: block;
}

.features-image-decoration {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 120px;
    height: 120px;
    background: var(--secondary-color);
    opacity: 0.1;
    border-radius: 50%;
    filter: blur(40px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .features-basic-content {
        flex-direction: column !important; /* Stack vertically */
        gap: 40px;
    }
    
    .features-text-section {
        flex: 1;
        padding-right: 0 !important;
        padding-left: 0 !important;
        order: 1 !important; /* Text always first */
    }
    
    .features-image-section {
        flex: 1;
        width: 100%;
        order: 2 !important; /* Image always second */
    }
    
    /* Left image = left align text on mobile */
    .features-basic-content.image-left .features-header {
        text-align: left;
    }
    
    .features-basic-content.image-left .features-subtitle-line .text-wrapper,
    .features-basic-content.image-left .features-title,
    .features-basic-content.image-left .body-t-xl {
        text-align: left;
    }
    
    /* Right image = right align text on mobile */
    .features-basic-content.image-right .features-header {
        text-align: right;
    }
    
    .features-basic-content.image-right .features-subtitle-line .text-wrapper {
        display: block;
        text-align: right;
    }
    
    .features-basic-content.image-right .features-title {
        text-align: right;
    }
    
    .features-basic-content.image-right .body-t-xl {
        text-align: right;
    }
    
    .features-subtitle-line .text-wrapper {
        font-size: 24px !important;
        font-weight: 700 !important;
        height: 36px;
        line-height: 36px;
    }
    
    .features-title {
        font-size: 34px !important;
        margin: 4px 0 12px !important;
    }
    
    .features-header .body-t-xl {
        font-size: 18px !important;
    }
}

@media (max-width: 480px) {
    .features-basic-container {
        padding: 60px 16px;
    }
}
</style>

@if($enableStrikethrough)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const containerId = '{{ $id }}';
    const container = document.getElementById(containerId);
    if (!container) return;
    
    const line1 = container.querySelector('.features-subtitle-line[data-scroll-animation="line1"]');
    const line2 = container.querySelector('.features-subtitle-line[data-scroll-animation="line2"]');
    
    if (!line1 || !line2) return;
    
    let line1Strikethrough = false;
    let line2Strikethrough = false;
    let lastScrollTop = 0;
    
    const handleScroll = () => {
        const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const line1Rect = line1.getBoundingClientRect();
        const line2Rect = line2.getBoundingClientRect();
        const windowHeight = window.innerHeight;
        
        // Handle line 1
        if (line1Rect.top < windowHeight * 0.7 && line1Rect.top > -line1Rect.height) {
            if (currentScrollTop > lastScrollTop && !line1Strikethrough) {
                // Scrolling down - add strikethrough to line 1
                line1.classList.remove('strikethrough-reverse');
                line1.classList.add('strikethrough-active');
                line1Strikethrough = true;
            } else if (currentScrollTop < lastScrollTop && line1Strikethrough && !line2Strikethrough) {
                // Scrolling up - remove strikethrough from line 1
                line1.classList.add('strikethrough-reverse');
                setTimeout(() => {
                    line1.classList.remove('strikethrough-active');
                    line1Strikethrough = false;
                }, 10);
            }
        }
        
        // Handle line 2 (triggers after line 1)
        if (line2Rect.top < windowHeight * 0.6 && line2Rect.top > -line2Rect.height) {
            if (currentScrollTop > lastScrollTop && line1Strikethrough && !line2Strikethrough) {
                // Scrolling down - add strikethrough to line 2
                setTimeout(() => {
                    line2.classList.remove('strikethrough-reverse');
                    line2.classList.add('strikethrough-active');
                    line2Strikethrough = true;
                }, 200); // Delay for sequential effect
            } else if (currentScrollTop < lastScrollTop && line2Strikethrough) {
                // Scrolling up - remove strikethrough from line 2
                line2.classList.add('strikethrough-reverse');
                setTimeout(() => {
                    line2.classList.remove('strikethrough-active');
                    line2Strikethrough = false;
                }, 10);
            }
        }
        
        lastScrollTop = currentScrollTop;
    };
    
    // Throttle scroll event for better performance
    let scrollTimeout;
    window.addEventListener('scroll', () => {
        if (scrollTimeout) {
            window.cancelAnimationFrame(scrollTimeout);
        }
        scrollTimeout = window.requestAnimationFrame(handleScroll);
    });
    
    // Initial check
    handleScroll();
});
</script>
@endif