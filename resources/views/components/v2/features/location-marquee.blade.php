{{--
    Location Marquee Component
    지점 정보가 포함된 마르퀴 컴포넌트
--}}

@props([
    'locations' => [
        ['name' => '강서구 공실앤톡점', 'image' => '/assets/media/main_page/f1.png'],
        ['name' => '마포구 공실앤톡점', 'image' => '/assets/media/main_page/f1.png'],
        ['name' => '종로구 공실앤톡점', 'image' => '/assets/media/main_page/f1.png'],
        ['name' => '강남구 공실앤톡점', 'image' => '/assets/media/main_page/f1.png'],
        ['name' => '서초구 공실앤톡점', 'image' => '/assets/media/main_page/f1.png'],
        ['name' => '송파구 공실앤톡점', 'image' => '/assets/media/main_page/f1.png'],
        ['name' => '영등포구 공실앤톡점', 'image' => '/assets/media/main_page/f1.png'],
        ['name' => '용산구 공실앤톡점', 'image' => '/assets/media/main_page/f1.png'],
    ],
    'speed' => 8, // seconds for one full cycle
    'containerClass' => '',
    'id' => 'location-marquee-' . uniqid()
])

<div class="location-marquee-container {{ $containerClass }}" id="{{ $id }}">
    <!-- First Row: Left to Right -->
    <div class="location-marquee-track marquee-left">
        <div class="location-marquee-content" data-row="1">
            @foreach(array_slice($locations, 0, 4) as $location)
                <div class="location-card">
                    <div class="location-text">{{ $location['name'] }}</div>
                    <div class="location-image">
                        <img src="{{ $location['image'] }}" alt="{{ $location['name'] }}" />
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Second Row: Right to Left -->
    <div class="location-marquee-track marquee-right">
        <div class="location-marquee-content" data-row="2">
            @foreach(array_slice($locations, 4, 4) as $location)
                <div class="location-card">
                    <div class="location-text">{{ $location['name'] }}</div>
                    <div class="location-image">
                        <img src="{{ $location['image'] }}" alt="{{ $location['name'] }}" />
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
.location-marquee-container {
    width: 100%;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.location-marquee-track {
    width: 100%;
    overflow: hidden;
    position: relative;
}

.location-marquee-content {
    display: flex;
    gap: 20px;
    margin: 0;
    padding: 0;
}

.location-marquee-track.marquee-left .location-marquee-content {
    animation: locationMarqueeScrollLeft {{ $speed }}s linear infinite;
}

.location-marquee-track.marquee-right .location-marquee-content {
    animation: locationMarqueeScrollRight {{ $speed }}s linear infinite;
    transform: translateX(-20%);
}

.location-card {
    flex: 0 0 200px;
    height: 120px;
    background: #FFFFFF;
    border-radius: 16px;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.location-text {
    position: absolute;
    top: 16px;
    right: 16px;
    font-size: 12px;
    font-weight: 600;
    color: #333;
    z-index: 2;
    line-height: 1.3;
}

.location-image {
    flex: 1;
    display: flex;
    align-items: flex-end;
    justify-content: flex-start;
    overflow: hidden;
    margin-top: auto;
}

.location-image img {
    width: auto;
    height: 80px;
    object-fit: contain;
    object-position: left bottom;
}

@keyframes locationMarqueeScrollLeft {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-20%);
    }
}

@keyframes locationMarqueeScrollRight {
    0% {
        transform: translateX(-20%);
    }
    100% {
        transform: translateX(0%);
    }
}

/* Pause animation on hover */
.location-marquee-container:hover .location-marquee-track {
    animation-play-state: paused;
}

/* Tablet Responsive */
@media (max-width: 1024px) {
    .location-card {
        flex: 0 0 180px;
        height: 100px;
    }
    
    .location-text {
        font-size: 11px;
        top: 12px;
        right: 12px;
    }
    
    .location-image img {
        height: 70px;
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .location-marquee-container {
        padding: 30px 0;
        gap: 15px;
    }
    
    .location-marquee-group {
        gap: 15px;
        padding-right: 15px;
    }
    
    .location-card {
        flex: 0 0 160px;
        height: 90px;
    }
    
    .location-text {
        font-size: 10px;
        top: 10px;
        right: 10px;
    }
    
    .location-image img {
        height: 60px;
    }
}

@media (max-width: 480px) {
    .location-card {
        flex: 0 0 140px;
        height: 80px;
    }
    
    .location-text {
        font-size: 9px;
        top: 8px;
        right: 8px;
    }
    
    .location-image img {
        height: 50px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const componentId = '{{ $id }}';
    const marqueeContents = document.querySelectorAll(`#${componentId} .location-marquee-content`);
    
    marqueeContents.forEach(content => {
        const originalItems = Array.from(content.children);
        
        // Clone all items multiple times for seamless infinite scroll
        for(let j = 0; j < 4; j++) {
            originalItems.forEach(item => {
                content.appendChild(item.cloneNode(true));
            });
        }
    });
});
</script>