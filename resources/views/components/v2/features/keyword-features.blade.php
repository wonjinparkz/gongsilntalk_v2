{{--
    Keyword Features Component
    어두운 배경에 흰색 키워드 박스를 표시하는 특징 컴포넌트
--}}

@props([
    'subtitle' => '사무실과 공실 관리, 전문가에게 맡기세요',
    'title' => '공실앤톡은<br>공실을 가치로 바꾸는 올인원 서비스입니다',
    'description' => '사무실•지식산업센터 운영에 필요한 모든 과정을 각 분야 전문가가 맞춤형으로 지원합니다.<br>공실 문제 해결부터 입주•운영•자산관리까지 한 번에 맡기세요.',
    'keywords' => [
        '부동산 중개팀',
        '공간디자인팀',
        '메타포트•촬영팀',
        '인테리어/가구',
        '마케팅•광고팀',
        '입주•운영팀',
        '데이터분석팀',
    ],
    'containerClass' => '',
    'backgroundColor' => '#262626',
])

<div class="keyword-features-container {{ $containerClass }}" style="background: {{ $backgroundColor }};">
    <div class="keyword-features-content">
        @if($subtitle)
            <p class="keyword-features-subtitle">{{ $subtitle }}</p>
        @endif
        
        @if($title)
            <h2 class="keyword-features-title">{!! $title !!}</h2>
        @endif
        
        @if($description)
            <p class="keyword-features-description">{!! $description !!}</p>
        @endif
        
        <div class="keyword-boxes-wrapper">
            <div class="keyword-row keyword-row-top">
                @foreach(array_slice($keywords, 0, 3) as $keyword)
                    <div class="keyword-box">
                        {{ $keyword }}
                    </div>
                @endforeach
            </div>
            <div class="keyword-row keyword-row-bottom">
                @foreach(array_slice($keywords, 3, 4) as $keyword)
                    <div class="keyword-box">
                        {{ $keyword }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
.keyword-features-container {
    width: 100%;
    padding: 100px 20px;
    background: #262626;
}

.keyword-features-content {
    max-width: 960px;
    margin: 0 auto;
    text-align: center;
}

.keyword-features-subtitle {
    font-size: 18px;
    font-weight: 400;
    color: #FFFFFF;
    opacity: 0.9;
    margin: 0 0 16px 0;
    line-height: 1.5;
}

.keyword-features-title {
    font-size: 42px;
    font-weight: 700;
    color: #FFFFFF;
    margin: 0 0 24px 0;
    line-height: 1.3;
}

.keyword-features-description {
    font-size: 16px;
    font-weight: 400;
    color: #FFFFFF;
    opacity: 0.8;
    line-height: 1.6;
    margin: 0 0 48px 0;
}

.keyword-boxes-wrapper {
    display: flex;
    flex-direction: column;
    gap: 16px;
    align-items: center;
}

.keyword-row {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
}

.keyword-box {
    padding: 14px 32px;
    background: #FFFFFF;
    border-radius: 30px;
    font-size: 16px;
    font-weight: 500;
    color: #262626;
    white-space: nowrap;
}

/* Tablet Responsive */
@media (max-width: 1024px) {
    .keyword-features-title {
        font-size: 36px;
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .keyword-features-container {
        padding: 60px 20px;
    }

    .keyword-features-subtitle {
        font-size: 16px;
    }

    .keyword-features-title {
        font-size: 28px;
        margin-bottom: 20px;
    }

    .keyword-features-description {
        font-size: 14px;
        margin-bottom: 32px;
    }

    .keyword-boxes-wrapper {
        gap: 12px;
    }

    .keyword-row {
        gap: 12px;
    }

    .keyword-box {
        padding: 12px 24px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .keyword-features-container {
        padding: 40px 16px;
    }

    .keyword-features-title {
        font-size: 24px;
    }

    .keyword-box {
        padding: 10px 20px;
        font-size: 13px;
    }
}
</style>