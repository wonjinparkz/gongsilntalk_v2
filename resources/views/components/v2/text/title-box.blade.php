@props([
    'subtitle' => '공실앤톡이 제공하는',
    'subtitleHighlight' => ['공실앤톡'], // 형광펜 효과를 적용할 키워드 배열
    'title' => '스마트한 부동산 솔루션',
    'alignment' => 'center', // 'left', 'center', 'right'
    'containerClass' => '',
    'id' => 'title-box-' . uniqid()
])

<div class="title-box-container {{ $containerClass }} align-{{ $alignment }}" id="{{ $id }}">
    <div class="title-box-content">
        <h5 class="title-box-subtitle">
            @php
                $subtitleText = $subtitle;
                foreach($subtitleHighlight as $highlight) {
                    $subtitleText = str_replace($highlight, '<span class="highlight-text">' . $highlight . '</span>', $subtitleText);
                }
            @endphp
            {!! $subtitleText !!}
        </h5>
        <h3 class="title-box-title">{!! $title !!}</h3>
    </div>
</div>

<style>
.title-box-container {
    width: 100%;
}

.title-box-content {
    display: flex;
    flex-direction: column;
    gap: 16px;
    max-width: 1080px;
    margin: 0 auto;
}

/* Alignment variations */
.title-box-container.align-left .title-box-content {
    text-align: left;
    align-items: flex-start;
}

.title-box-container.align-center .title-box-content {
    text-align: center;
    align-items: center;
}

.title-box-container.align-right .title-box-content {
    text-align: right;
    align-items: flex-end;
}

/* Title styles using h5 and h3 from common.css */
.title-box-subtitle {
    font-size: 24px !important;
    font-weight: 400 !important;
    line-height: 1.5;
    color: #000;
    margin: 0;
    position: relative;
    display: inline-block;
}

.title-box-title {
    font-size: 48px !important;
    font-weight: 700 !important;
    line-height: 1.35;
    letter-spacing: -0.5px;
    color: #000;
    margin: 0;
}

/* Highlight effect for subtitle keywords */
.highlight-text {
    position: relative;
    font-weight: 700;
    display: inline-block;
    z-index: 1;
    font-size: inherit !important;
    line-height: inherit !important;
    color: inherit;
}

.highlight-text::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: -2px;
    right: -2px;
    height: 40%;
    background: linear-gradient(90deg, rgba(0, 140, 255, 0.4) 0%, rgba(0, 140, 255, 0.4) 100%);
    z-index: -1;
    transform: skewY(-1deg);
    border-radius: 2px;
}

/* Alternative highlight styles (can be activated with additional classes) */
.highlight-text.style-underline::after {
    height: 3px;
    bottom: -2px;
    background: var(--primary-color);
    transform: none;
    border-radius: 0;
}

.highlight-text.style-box::after {
    height: 100%;
    bottom: 0;
    background: rgba(65, 144, 241, 0.1);
    transform: none;
    padding: 2px 4px;
    border-radius: 4px;
}

.highlight-text.style-circle::after {
    height: 100%;
    width: calc(100% + 8px);
    bottom: -2px;
    left: -4px;
    background: transparent;
    border: 2px solid var(--primary-color);
    border-radius: 20px;
    transform: none;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    
    .title-box-content {
        gap: 8px;
    }
    
    .title-box-subtitle {
        font-size: 16px !important;
    }
    
    .title-box-title {
        font-size: 30px !important;
    }
    
    .highlight-text::after {
        height: 35%;
    }
}

@media (max-width: 480px) {
    
    .title-box-subtitle {
        font-size: 16px !important;
    }
    
    .title-box-title {
        font-size: 24px !important;
    }
}
</style>