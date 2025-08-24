@props([
    'logos' => [
        // First row logos
        'row1' => [
            ['src' => '/assets/media/brand_01.png', 'alt' => 'Client 1'],
            ['src' => '/assets/media/brand_02.png', 'alt' => 'Client 2'],
            ['src' => '/assets/media/brand_03.png', 'alt' => 'Client 3'],
            ['src' => '/assets/media/brand_04.png', 'alt' => 'Client 4'],
            ['src' => '/assets/media/brand_05.png', 'alt' => 'Client 5'],
            ['src' => '/assets/media/brand_06.png', 'alt' => 'Client 6'],
            ['src' => '/assets/media/brand_07.png', 'alt' => 'Client 7'],
            ['src' => '/assets/media/brand_08.png', 'alt' => 'Client 8'],
            ['src' => '/assets/media/brand_09.png', 'alt' => 'Client 9'],
        ],
        // Second row logos
        'row2' => [
            ['src' => '/assets/media/brand_10.png', 'alt' => 'Client 10'],
            ['src' => '/assets/media/brand_11.png', 'alt' => 'Client 11'],
            ['src' => '/assets/media/brand_12.png', 'alt' => 'Client 12'],
            ['src' => '/assets/media/brand_13.png', 'alt' => 'Client 13'],
            ['src' => '/assets/media/brand_14.png', 'alt' => 'Client 14'],
            ['src' => '/assets/media/brand_15.png', 'alt' => 'Client 15'],
            ['src' => '/assets/media/brand_16.png', 'alt' => 'Client 16'],
            ['src' => '/assets/media/brand_17.png', 'alt' => 'Client 17'],
            ['src' => '/assets/media/brand_18.png', 'alt' => 'Client 18'],
        ],
        // Third row logos
        'row3' => [
            ['src' => '/assets/media/brand_19.png', 'alt' => 'Client 19'],
            ['src' => '/assets/media/brand_20.png', 'alt' => 'Client 20'],
            ['src' => '/assets/media/brand_21.png', 'alt' => 'Client 21'],
            ['src' => '/assets/media/brand_22.png', 'alt' => 'Client 22'],
            ['src' => '/assets/media/brand_23.png', 'alt' => 'Client 23'],
            ['src' => '/assets/media/brand_24.png', 'alt' => 'Client 24'],
            ['src' => '/assets/media/brand_25.png', 'alt' => 'Client 25'],
            ['src' => '/assets/media/brand_26.png', 'alt' => 'Client 26'],
            ['src' => '/assets/media/brand_27.png', 'alt' => 'Client 27'],
        ],
    ],
    'containerClass' => '',
    'id' => 'client-logos-' . uniqid(),
    'animationSpeed' => 30, // seconds for one complete scroll
    'logoHeight' => 60, // height of logos in pixels
])

<div class="client-logos-container {{ $containerClass }}" id="{{ $id }}">
    <div class="marquee-wrapper">
        <!-- Row 1: Scrolling left -->
        <div class="marquee-row">
            <div class="marquee marquee-left">
                <ul class="marquee-content" data-row="1">
                    @foreach($logos['row1'] as $logo)
                        <li><img src="{{ $logo['src'] }}" alt="{{ $logo['alt'] }}"></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Row 2: Scrolling right -->
        <div class="marquee-row">
            <div class="marquee marquee-right">
                <ul class="marquee-content" data-row="2">
                    @foreach($logos['row2'] as $logo)
                        <li><img src="{{ $logo['src'] }}" alt="{{ $logo['alt'] }}"></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Row 3: Scrolling left -->
        <div class="marquee-row">
            <div class="marquee marquee-left">
                <ul class="marquee-content" data-row="3">
                    @foreach($logos['row3'] as $logo)
                        <li><img src="{{ $logo['src'] }}" alt="{{ $logo['alt'] }}"></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
#{{ $id }} {
    --marquee-width: 100%;
    --marquee-height: 100px;
    --marquee-elements-displayed: 6;
    --marquee-element-width: calc(var(--marquee-width) / var(--marquee-elements-displayed));
    --marquee-animation-duration: {{ $animationSpeed }}s;
    --logo-height: {{ $logoHeight }}px;
}

#{{ $id }} .client-logos-container {
    width: 100%;
    background-color: #FFFFFF;
    padding: 60px 0;
    overflow: hidden;
}

#{{ $id }} .marquee-wrapper {
    max-width: 1280px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 24px;
}

#{{ $id }} .marquee-row {
    width: 100%;
    position: relative;
}

#{{ $id }} .marquee {
    width: var(--marquee-width);
    height: var(--marquee-height);
    overflow: hidden;
    position: relative;
}

/* Gradient masks for smooth edges */
#{{ $id }} .marquee:before,
#{{ $id }} .marquee:after {
    position: absolute;
    top: 0;
    width: 100px;
    height: 100%;
    content: "";
    z-index: 2;
    pointer-events: none;
}

#{{ $id }} .marquee:before {
    left: 0;
    background: linear-gradient(to right, #FFFFFF 0%, transparent 100%);
}

#{{ $id }} .marquee:after {
    right: 0;
    background: linear-gradient(to left, #FFFFFF 0%, transparent 100%);
}

#{{ $id }} .marquee-content {
    list-style: none;
    height: 100%;
    display: flex;
    margin: 0;
    padding: 0;
    gap: 40px;
}

/* Left scrolling animation */
#{{ $id }} .marquee-left .marquee-content {
    animation: scrolling-left var(--marquee-animation-duration) linear infinite;
}

/* Right scrolling animation */
#{{ $id }} .marquee-right .marquee-content {
    animation: scrolling-right var(--marquee-animation-duration) linear infinite;
}

@keyframes scrolling-left {
    0% { 
        transform: translateX(0); 
    }
    100% { 
        transform: translateX(calc(-100% - 40px)); 
    }
}

@keyframes scrolling-right {
    0% { 
        transform: translateX(calc(-100% - 40px)); 
    }
    100% { 
        transform: translateX(0); 
    }
}

#{{ $id }} .marquee-content li {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-shrink: 0;
    padding: 0 30px;
    height: var(--marquee-height);
}

#{{ $id }} .marquee-content li img {
    width: auto;
    height: var(--logo-height);
    object-fit: contain;
    opacity: 1;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    #{{ $id }} {
        --marquee-elements-displayed: 4;
        --logo-height: 40px;
        --marquee-height: 80px;
    }
    
    #{{ $id }} .client-logos-container {
        padding: 40px 0;
    }
    
    #{{ $id }} .marquee-wrapper {
        gap: 16px;
    }
    
    #{{ $id }} .marquee:before,
    #{{ $id }} .marquee:after {
        width: 50px;
    }
    
    #{{ $id }} .marquee-content {
        gap: 20px;
    }
    
    #{{ $id }} .marquee-content li {
        padding: 0 15px;
    }
}

@media (max-width: 480px) {
    #{{ $id }} {
        --marquee-elements-displayed: 3;
        --logo-height: 35px;
        --marquee-height: 70px;
    }
    
    #{{ $id }} .client-logos-container {
        padding: 30px 0;
    }
    
    #{{ $id }} .marquee-wrapper {
        gap: 12px;
    }
    
    #{{ $id }} .marquee:before,
    #{{ $id }} .marquee:after {
        width: 30px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const componentId = '{{ $id }}';
    const marqueeContents = document.querySelectorAll(`#${componentId} .marquee-content`);
    
    marqueeContents.forEach(content => {
        const originalItems = Array.from(content.children);
        const itemsToClone = originalItems.length;
        
        // Clone all items twice for seamless infinite scroll
        for(let j = 0; j < 2; j++) {
            originalItems.forEach(item => {
                content.appendChild(item.cloneNode(true));
            });
        }
    });
});
</script>