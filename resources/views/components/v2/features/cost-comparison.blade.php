{{--
    Cost Comparison Component
    좌측 텍스트와 원형 배지, 우측 비교 박스 및 이미지가 있는 비용 비교 컴포넌트
--}}

@props([
    'mainTitle' => '초기비용 단돈 0원',
    'titleHighlight' => ['단돈 0원'],
    'description' => [
        '크고 넓은 라운지 구축 비용?',
        '깔끔하고 세련된 사무실 인테리어 비용?',
        '공실앤톡은 다 완성되어 무료입니다.'
    ],
    'badge' => [
        'amount' => '2억 4,000만원',
        'label' => 'SAVE'
    ],
    'leftBox' => [
        'title' => '임대사무실 약 2.4억원',
        'titleHighlight' => ['2.4억원'],
        'bgColor' => '#333333'
    ],
    'rightBox' => [
        'title' => '공실앤톡 0원',
        'titleHighlight' => ['0원'],
        'bgColor' => '#FFD700'
    ],
    'centerDescription' => '평균 인테리어 비용<br>(50인 사무실 - 120평)',
    'backgroundImage' => '/assets/media/type3_img_1.png',
    'imagePosition' => 'right', // 'right' 또는 'left'
    'containerClass' => '',
    'id' => 'cost-comparison-' . uniqid()
])

<div class="cost-comparison-container {{ $containerClass }}" id="{{ $id }}">
    <div class="cost-comparison-wrapper">
        <div class="cost-comparison-content {{ $imagePosition === 'left' ? 'image-left' : '' }}">
            <!-- 텍스트 영역 -->
            <div class="cost-text-section {{ $imagePosition === 'left' ? 'text-right' : '' }}">
                <h2 class="cost-main-title">
                    @php
                        $titleText = $mainTitle;
                        foreach($titleHighlight as $highlight) {
                            $titleText = str_replace($highlight, '<span class="cost-highlight">' . $highlight . '</span>', $titleText);
                        }
                    @endphp
                    {!! $titleText !!}
                </h2>
                
                <div class="cost-description">
                    @foreach($description as $line)
                        <p class="cost-description-line">{{ $line }}</p>
                    @endforeach
                </div>
                
                <!-- 원형 할인 배지 -->
                <div class="cost-badge">
                    <div class="badge-content">
                        <div class="badge-amount">{{ $badge['amount'] }}</div>
                        <div class="badge-label">{{ $badge['label'] }}</div>
                    </div>
                </div>
            </div>
            
            <!-- 비교 박스 및 이미지 영역 -->
            <div class="cost-comparison-section {{ $imagePosition === 'left' ? 'section-right' : '' }}" 
                 data-badge-amount="{{ $badge['amount'] }}" 
                 data-badge-label="{{ $badge['label'] }}">
                <!-- 비교 박스 -->
                <div class="comparison-box-wrapper">
                    <div class="comparison-box">
                        <!-- 좌측 박스 (검은색) -->
                        <div class="comparison-left" style="background: {{ $leftBox['bgColor'] }};">
                            <span style="color:#fff;">
                                @php
                                    $leftTitleText = $leftBox['title'];
                                    $leftHighlightText = '';
                                    if(isset($leftBox['titleHighlight'])) {
                                        foreach($leftBox['titleHighlight'] as $highlight) {
                                            $leftTitleText = str_replace($highlight, '', $leftTitleText);
                                            $leftHighlightText = $highlight;
                                        }
                                        $leftTitleText = trim($leftTitleText);
                                    }
                                @endphp
                                <span class="comparison-base-text">{{ $leftTitleText }}</span>
                                @if($leftHighlightText)
                                    <span class="comparison-highlight">{{ $leftHighlightText }}</span>
                                @endif
                            </span>
                        </div>
                        
                        <!-- 중앙 화살표 -->
                        <div class="comparison-arrow">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        
                        <!-- 우측 박스 (노란색) -->
                        <div class="comparison-right" style="background: {{ $rightBox['bgColor'] }};">
                            <span>
                                @php
                                    $rightTitleText = $rightBox['title'];
                                    $rightHighlightText = '';
                                    if(isset($rightBox['titleHighlight'])) {
                                        foreach($rightBox['titleHighlight'] as $highlight) {
                                            $rightTitleText = str_replace($highlight, '', $rightTitleText);
                                            $rightHighlightText = $highlight;
                                        }
                                        $rightTitleText = trim($rightTitleText);
                                    }
                                @endphp
                                <span class="comparison-base-text">{{ $rightTitleText }}</span>
                                @if($rightHighlightText)
                                    <span class="comparison-highlight">{{ $rightHighlightText }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    
                    <!-- 중앙 설명 -->
                    <div class="comparison-description">
                        {!! $centerDescription !!}
                    </div>
                </div>
                
                <!-- 이미지 -->
                <div class="comparison-image-wrapper">
                    <div class="image-gradient-overlay"></div>
                    <img src="{{ $backgroundImage }}" alt="오피스 이미지" class="comparison-image">
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.cost-comparison-container {
    width: 100%;
    background: #FFFFFF;
    overflow: hidden;
}

.cost-comparison-wrapper {
    max-width: 1080px;
    margin: 0 auto;
}

.cost-comparison-content {
    display: flex;
    align-items: flex-start;
    gap: 80px;
    height: 350px;
    overflow: hidden;
}

.cost-comparison-content.image-left {
    flex-direction: row-reverse;
}

.cost-text-section {
    flex: 1;
    max-width: 500px;
    display: flex;
    flex-direction: column;
}

.cost-text-section.text-right {
    align-items: flex-end;
    text-align: right;
}

.cost-text-section:not(.text-right) {
    text-align: left;
}

.cost-main-title {
    font-size: 36px;
    font-weight: 700;
    line-height: 1.3;
    color: #222;
    margin: 0 0 24px 0;
}

.cost-main-title .cost-highlight {
    color: #FF8C00;
    font-weight: 700;
    font-size: inherit;
}

.cost-description {
}

.cost-description-line {
    font-size: 18px;
    font-weight: 400;
    line-height: 1.6;
    color: #333;
    margin: 0;
}

.cost-description-line:last-child {
    margin-bottom: 0;
    font-weight: 600;
    color: #222;
}

.cost-badge {
    width: 140px;
    height: 140px;
    background: #DD8400;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 20px 0 0 0;
}

.badge-content {
    text-align: center;
    color: #FFFFFF;
}

.badge-amount {
    font-size: 14px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 4px;
    color: #fff;
}

.badge-label {
    font-size: 28px;
    font-weight: 900;
    letter-spacing: 1px;
    color: #fff;
}


.cost-comparison-section {
    flex: 1;
    max-width: 635px;
    height: 350px;
    position: relative;
    display: flex;
    flex-direction: column;
}

.comparison-box-wrapper {
    margin-bottom: 0;
    flex-shrink: 0;
}

.comparison-box {
    width: 635px;
    height: 60px;
    border-radius: 10px 10px 0 0;
    overflow: hidden;
    display: flex;
    align-items: center;
    position: relative;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.comparison-left {
    flex: 1;
    height: 100%;
    background: #333333;
    color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 600;
}

.comparison-arrow {
    width: 50px;
    height: 100%;
    background: linear-gradient(90deg, #333333 0%, #FFD700 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 1;
}

.comparison-right {
    flex: 1;
    height: 100%;
    background: #FFD700;
    color: #333333;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 600;
}

.comparison-left .comparison-highlight {
    font-size: 1.25em;
    font-weight: inherit;
    color: #FFFFFF;
}

.comparison-right .comparison-highlight {
    font-size: 1.25em;
    font-weight: inherit;
    color: #333333;
}

.comparison-base-text {
    display: inline;
}

.comparison-left .comparison-base-text {
    color: #FFFFFF;
}

.comparison-right .comparison-base-text {
    color: #333333;
}

.comparison-description {
    text-align: center;
    font-size: 14px;
    font-weight: 400;
    color: #666;
    line-height: 1.4;
    margin: 16px 0 20px 0;
    flex-shrink: 0;
}

.comparison-image-wrapper {
    position: relative;
    width: 100%;
    flex: 1;
    border-radius: 0 0 16px 16px;
    overflow: hidden;
    min-height: 0;
}

.image-gradient-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 80px;
    background: linear-gradient(180deg, #FFFFFF 0%, rgba(255, 255, 255, 0) 100%);
    z-index: 1;
}

.comparison-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

/* Tablet Responsive */
@media (max-width: 1024px) {
    .cost-comparison-content {
        gap: 40px;
        flex-direction: column;
        align-items: center;
    }
    
    .cost-text-section {
        max-width: 100%;
        text-align: center;
    }
    
    .cost-text-section.text-right {
        text-align: center;
        align-items: center;
    }
    
    .cost-main-title {
        font-size: 32px;
    }
    
    .cost-description-line {
        font-size: 16px;
    }
    
    .cost-badge {
        width: 150px;
        height: 150px;
        margin: 40px auto 0;
    }
    
    .comparison-box {
        width: 100%;
        max-width: 500px;
    }
    
    .comparison-image-wrapper {
        height: 300px;
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .cost-comparison-container {
        position: relative;
    }
    
    .cost-comparison-content {
        gap: 0;
        flex-direction: column !important;
        height: auto;
    }
    
    .cost-comparison-content.image-left {
        flex-direction: column !important;
    }
    
    .cost-text-section {
        order: 1;
        margin-bottom: 40px;
        max-width: 100%;
    }
    
    .cost-text-section.text-right {
        text-align: center;
        align-items: center;
    }
    
    .cost-comparison-section {
        order: 2;
        max-width: 100%;
        height: auto;
        position: relative;
    }
    
    .cost-main-title {
        font-size: 32px;
        margin-bottom: 24px;
    }
    
    .cost-description {
        margin-bottom: 0;
    }
    
    .cost-description-line {
        font-size: 15px;
        margin-bottom: 6px;
    }
    
    .cost-badge {
        display: none;
    }
    
    .comparison-box-wrapper {
        margin-bottom: 20px;
    }
    
    .comparison-box {
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        height: 60px;
    }
    
    .comparison-left,
    .comparison-right {
        font-size: 12px;
        text-align: center;
        flex-direction: column;
        justify-content: center;
        line-height: 1.3;
    }
    
    .comparison-left .comparison-highlight,
    .comparison-right .comparison-highlight {
        font-size: 1.1em;
        display: block;
        margin-top: 2px;
    }
    
    .comparison-left .comparison-base-text {
        color: #FFFFFF;
    }
    
    .comparison-left .comparison-highlight {
        color: #FFFFFF !important;
    }
    
    .comparison-right .comparison-base-text {
        color: #333333;
    }
    
    .comparison-right .comparison-highlight {
        color: #333333 !important;
    }
    
    .comparison-description {
        font-size: 13px;
        margin: 12px 0 0 0;
    }
    
    .comparison-image-wrapper {
        height: 250px;
        position: relative;
    }
    
    /* 모바일 뱃지 스타일 */
    .cost-comparison-section::after {
        content: attr(data-badge-amount) ' ' attr(data-badge-label);
        position: absolute;
        bottom: 20px;
        left: 20px;
        background: #DD8400;
        color: #FFFFFF;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 700;
        z-index: 2;
        white-space: nowrap;
    }
    
    .cost-comparison-section.section-right::after {
        left: auto;
        right: 20px;
    }
}

@media (max-width: 480px) {
    .cost-comparison-container {
    }
    
    .cost-main-title {
        font-size: 28px;
    }
    
    .cost-description-line {
        font-size: 14px;
    }
    
    .comparison-box {
        height: 50px;
    }
    
    .comparison-left,
    .comparison-right {
        font-size: 11px;
    }
    
    .comparison-left .comparison-highlight,
    .comparison-right .comparison-highlight {
        font-size: 1.05em;
    }
    
    .comparison-left .comparison-base-text,
    .comparison-left .comparison-highlight {
        color: #FFFFFF !important;
    }
    
    .comparison-right .comparison-base-text,
    .comparison-right .comparison-highlight {
        color: #333333 !important;
    }
    
    .comparison-arrow {
        width: 40px;
    }
    
    .comparison-image-wrapper {
        height: 200px;
    }
    
    .cost-comparison-section::after {
        bottom: 15px;
        left: 15px;
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 16px;
    }
    
    .cost-comparison-section.section-right::after {
        left: auto;
        right: 15px;
    }
}
</style>