{{--
    Simple Gallery Component
    탭 없이 이미지를 좌우 50%로 표시하는 심플 갤러리
    기본적으로 /assets/media/gallery 경로의 이미지를 사용
--}}

@props([
    'leftImage' => null,
    'rightImage' => null,
    'imageIndex' => 1, // 기본 이미지 인덱스
    'leftAlt' => '갤러리 이미지',
    'rightAlt' => '갤러리 이미지',
    'height' => '600px',
    'containerClass' => '',
])

@php
    // 이미지가 지정되지 않은 경우 gallery 폴더에서 자동으로 가져오기
    if (!$leftImage) {
        $leftImage = "/assets/media/gallery/{$imageIndex}.jpg";
    }
    
    if (!$rightImage) {
        // 우측 이미지도 지정되지 않은 경우, 같은 이미지 또는 다음 이미지 사용
        $nextIndex = $imageIndex + 1;
        // gallery 폴더의 이미지 개수 확인
        $galleryPath = public_path('assets/media/gallery');
        $imageCount = 0;
        if (file_exists($galleryPath)) {
            $files = scandir($galleryPath);
            foreach ($files as $file) {
                if (preg_match('/^\d+\.(jpg|jpeg|png|gif)$/i', $file)) {
                    $imageCount++;
                }
            }
        }
        
        // 다음 이미지가 있으면 사용, 없으면 같은 이미지 사용
        if ($nextIndex <= $imageCount) {
            $rightImage = "/assets/media/gallery/{$nextIndex}.jpg";
        } else {
            $rightImage = $leftImage;
        }
    }
@endphp

<div class="simple-gallery-container {{ $containerClass }}">
    <div class="simple-gallery-content" style="height: {{ $height }};">
        <div class="simple-gallery-left">
            <img src="{{ $leftImage }}" 
                 alt="{{ $leftAlt }}"
                 onerror="this.src='/assets/media/placeholder.jpg'">
        </div>
        <div class="simple-gallery-right">
            <img src="{{ $rightImage }}" 
                 alt="{{ $rightAlt }}"
                 onerror="this.src='/assets/media/placeholder.jpg'">
        </div>
    </div>
</div>

<style>
.simple-gallery-container {
    width: 100%;
    margin: 0 auto;
}

.simple-gallery-content {
    display: flex;
    width: 100%;
    gap: 0;
    overflow: hidden;
}

.simple-gallery-left,
.simple-gallery-right {
    width: 50%;
    height: 100%;
    overflow: hidden;
    position: relative;
}

.simple-gallery-left img,
.simple-gallery-right img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.simple-gallery-left:hover img,
.simple-gallery-right:hover img {
    transform: scale(1.05);
}

/* Responsive */
@media (max-width: 768px) {
    .simple-gallery-content {
        flex-direction: column;
        height: auto !important;
    }
    
    .simple-gallery-left,
    .simple-gallery-right {
        width: 100%;
        height: 300px;
    }
}

@media (max-width: 480px) {
    .simple-gallery-left,
    .simple-gallery-right {
        height: 200px;
    }
}
</style>