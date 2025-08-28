{{--
    Process Steps Component
    6단계 프로세스 스텝 컴포넌트
--}}

@props([
    'steps' => [
        ['number' => '01', 'title' => '상담 신청'],
        ['number' => '02', 'title' => '매물 분석'],
        ['number' => '03', 'title' => 'VR 촬영'],
        ['number' => '04', 'title' => '공간 설계'],
        ['number' => '05', 'title' => '계약 진행'],
        ['number' => '06', 'title' => '입주 완료']
    ],
    'durations' => ['1일', '2일', '1일', '3일', '2일'],
    'containerClass' => '',
    'id' => 'gsnt-ps-' . uniqid()
])

<div class="gsnt-ps-container {{ $containerClass }}" id="{{ $id }}">
    <div class="gsnt-ps-process-grid">
        <!-- 모든 단계를 순서대로 배치 -->
        <div class="gsnt-ps-all-steps">
            @for($i = 0; $i < 6; $i++)
                <div class="gsnt-ps-step-wrapper">
                    <div class="gsnt-ps-step">
                        <div class="gsnt-ps-circle">
                            <div class="gsnt-ps-step-line">
                                <span class="gsnt-ps-number">{{ $steps[$i]['number'] }}</span>
                                <span class="gsnt-ps-step-label">STEP</span>
                            </div>
                            <div class="gsnt-ps-title">{{ $steps[$i]['title'] }}</div>
                        </div>
                    </div>
                    
                    @if($i < 5)
                        <div class="gsnt-ps-connector gsnt-ps-connector-horizontal">
                            <div class="gsnt-ps-duration">{{ $durations[$i] }}</div>
                        </div>
                    @endif
                </div>
            @endfor
            
            <!-- 6번 스텝 아래 화살표 -->
            <div class="gsnt-ps-mobile-arrow">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" class="gsnt-ps-mobile-arrow-icon">
                    <path d="M12 15L20 23L28 15" stroke="#DBDBFA" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
        
        <!-- 데스크탑용 레이아웃 (숨김) -->
        <div class="gsnt-ps-desktop-layout">
            <!-- 첫 번째 행 (1-2-3단계) -->
            <div class="gsnt-ps-row gsnt-ps-row-top">
                @for($i = 0; $i < 3; $i++)
                    <div class="gsnt-ps-step-wrapper">
                        <div class="gsnt-ps-step">
                            <div class="gsnt-ps-circle">
                                <div class="gsnt-ps-step-line">
                                    <span class="gsnt-ps-number">{{ $steps[$i]['number'] }}</span>
                                    <span class="gsnt-ps-step-label">STEP</span>
                                </div>
                                <div class="gsnt-ps-title">{{ $steps[$i]['title'] }}</div>
                            </div>
                        </div>
                        
                        @if($i < 2)
                            <div class="gsnt-ps-connector gsnt-ps-connector-horizontal">
                                <div class="gsnt-ps-duration">{{ $durations[$i] }}</div>
                            </div>
                        @endif
                    </div>
                @endfor
            </div>
            
            <!-- 두 번째 행 (6-5-4단계) -->
            <div class="gsnt-ps-row gsnt-ps-row-bottom">
                @for($i = 5; $i >= 3; $i--)
                    <div class="gsnt-ps-step-wrapper">
                        @if($i == 5)
                            <div class="gsnt-ps-connector gsnt-ps-connector-horizontal gsnt-ps-connector-arrow">
                                <div class="gsnt-ps-arrow-triangle"></div>
                            </div>
                        @endif
                        
                        <div class="gsnt-ps-step">
                            <div class="gsnt-ps-circle">
                                <div class="gsnt-ps-step-line">
                                    <span class="gsnt-ps-number">{{ $steps[$i]['number'] }}</span>
                                    <span class="gsnt-ps-step-label">STEP</span>
                                </div>
                                <div class="gsnt-ps-title">{{ $steps[$i]['title'] }}</div>
                            </div>
                        </div>
                        
                        @if($i > 3)
                            <div class="gsnt-ps-connector gsnt-ps-connector-horizontal">
                                <div class="gsnt-ps-duration">{{ $durations[$i-1] }}</div>
                            </div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>
        
        <!-- 3번과 4번을 연결하는 U자 연결선 -->
        <div class="gsnt-ps-u-connector">
            <div class="gsnt-ps-u-line">
                <div class="gsnt-ps-duration gsnt-ps-duration-vertical">{{ $durations[2] }}</div>
            </div>
        </div>
    </div>
</div>

<style>
.gsnt-ps-container {
    width: 100%;
    max-width: 1380px;
    margin: 0 auto;
    padding: 0 50px;
    box-sizing: border-box;
}

.gsnt-ps-process-grid {
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 0px;
}

/* 모바일용 순서대로 배치 */
.gsnt-ps-all-steps {
    display: none;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

.gsnt-ps-all-steps .gsnt-ps-step-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.gsnt-ps-all-steps .gsnt-ps-connector-horizontal {
    width: 40px;
    height: 40px;
    margin: -30px 0;
}

/* 모바일 화살표 */
.gsnt-ps-mobile-arrow {
    display: none;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.gsnt-ps-mobile-arrow-icon {
    flex-shrink: 0;
}

/* 데스크탑용 레이아웃 */
.gsnt-ps-desktop-layout {
    display: flex;
    flex-direction: column;
    gap: 0px;
}

.gsnt-ps-row {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.gsnt-ps-step-wrapper {
    display: flex;
    align-items: center;
    position: relative;
}

.gsnt-ps-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
    position: relative;
    z-index: 3;
    margin-bottom: 20px;
}

.gsnt-ps-circle {
    width: 120px;
    height: 120px;
    background: white;
    border: 3px solid #DBDBFA;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 2px;
    position: relative;
    padding: 10px;
    box-sizing: border-box;
}

.gsnt-ps-step-line {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 12px;
}

.gsnt-ps-number {
    font-size: 12px;
    font-weight: 700;
    color: #222;
    line-height: 1;
}

.gsnt-ps-step-label {
    font-size: 12px;
    font-weight: 500;
    color: #666;
    line-height: 1;
}

.gsnt-ps-title {
    font-size: 20px;
    font-weight: 600;
    color: #A59EF9;
    text-align: center;
    line-height: 1.2;
}

/* 가로 연결선 */
.gsnt-ps-connector-horizontal {
    width: 80px;
    height: 40px;
    background: #DBDBFA;
    position: relative;
    margin: 0 -10px;
    z-index: 1;
    margin-bottom: 20px;
}

.gsnt-ps-duration {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 600;
    color: #222;
    border-radius: 20px;
    white-space: nowrap;
    z-index: 2;
}

/* U자 연결선 */
.gsnt-ps-u-connector {
    position: absolute;
    top: 48%;
    right: calc(50% - 300px);
    transform: translateY(-50%);
    z-index: 1;
}

.gsnt-ps-u-line {
    width: 100px;
    height: 100px;
    border: 40px solid #DBDBFA;
    border-left: none;
    border-radius: 0 50px 50px 0;
    position: relative;
}

.gsnt-ps-duration-vertical {
    position: absolute;
    top: 50%;
    left: 100%;
    transform: translate(0, -50%);
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 600;
    color: #222;
    border-radius: 20px;
    white-space: nowrap;
    z-index: 2;
}

/* 화살표 연결선 */
.gsnt-ps-connector-arrow {
    position: absolute;
    left: -50px;
    top: 44%;
    transform: translateY(-50%);
}

.gsnt-ps-arrow-triangle {
    position: absolute;
    left: -20px;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-top: 40px solid transparent;
    border-bottom: 40px solid transparent;
    border-right: 40px solid #DBDBFA;
    z-index: 3;
}

/* Tablet */
@media (max-width: 1024px) {
    .gsnt-ps-container {
        padding: 0 30px;
    }
    
    .gsnt-ps-process-grid {
        gap: 100px;
    }
    
    .gsnt-ps-circle {
        width: 100px;
        height: 100px;
    }
    
    .gsnt-ps-number {
        font-size: 28px;
    }
    
    .gsnt-ps-title {
        font-size: 16px;
    }
    
    .gsnt-ps-connector-horizontal {
        margin: 0 15px;
    }
}

/* Tablet */
@media (max-width: 1024px) {
    .gsnt-ps-all-steps {
        display: none;
    }
    
    .gsnt-ps-desktop-layout {
        display: flex;
        flex-direction: column;
        gap: 100px;
    }
}

/* Mobile */
@media (max-width: 768px) {
    .gsnt-ps-container {
        padding: 0 20px;
    }
    
    .gsnt-ps-all-steps {
        display: flex;
    }
    
    .gsnt-ps-desktop-layout {
        display: none;
    }
    
    .gsnt-ps-circle {
        width: 120px;
        height: 120px;
    }
    
    .gsnt-ps-number {
        font-size: 12px;
    }
    
    .gsnt-ps-step-label {
        font-size: 12px;
    }
    
    .gsnt-ps-title {
        font-size: 20px;
    }
    
    .gsnt-ps-all-steps .gsnt-ps-duration {
        transform: translate(-50%, -50%);
        font-size: 12px;
        padding: 6px 12px;
    }
    
    /* U자 연결선 숨김 */
    .gsnt-ps-u-connector {
        display: none;
    }
    
    /* 모바일 화살표 표시 */
    .gsnt-ps-mobile-arrow {
        display: flex;
    }
}

@media (max-width: 480px) {
    .gsnt-ps-container {
        padding: 0 16px;
    }
    
    .gsnt-ps-circle {
        width: 120px;
        height: 120px;
    }
    
    .gsnt-ps-number {
        font-size: 12px;
    }
    
    .gsnt-ps-step-label {
        font-size: 12px;
    }
    
    .gsnt-ps-title {
        font-size: 20px;
    }
}
</style>