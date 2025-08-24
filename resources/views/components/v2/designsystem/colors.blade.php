<div class="design-system-colors" style="padding: 30px; background: white;">
    <h2 style="font-size: 28px; font-weight: 700; color: #333; margin-bottom: 40px; padding-bottom: 15px; border-bottom: 2px solid #F16341;">
        🎨 Color Tokens
    </h2>
    
    <!-- Primary Colors -->
    <div style="margin-bottom: 50px;">
        <h3 style="font-size: 20px; color: #555; margin-bottom: 25px;">Primary & Secondary Colors</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            @php
                $primaryColors = [
                    ['name' => 'Primary', 'var' => '--primary-color', 'hex' => '#F16341', 'desc' => '메인 브랜드 컬러'],
                    ['name' => 'Primary Light', 'var' => '--primary-color-light', 'hex' => '#FF8A65', 'desc' => '밝은 강조'],
                    ['name' => 'Primary Dark', 'var' => '--primary-color-dark', 'hex' => '#D84315', 'desc' => '어두운 강조'],
                    ['name' => 'Primary BG', 'var' => '--primary-bg', 'hex' => '#FFF5F2', 'desc' => '배경색'],
                    ['name' => 'Secondary', 'var' => '--secondary-color', 'hex' => '#007FFF', 'desc' => '세컨더리 컬러'],
                    ['name' => 'Secondary Light', 'var' => '--secondary-color-light', 'hex' => '#4DA3FF', 'desc' => '밝은 세컨더리'],
                    ['name' => 'Secondary Dark', 'var' => '--secondary-color-dark', 'hex' => '#0066CC', 'desc' => '어두운 세컨더리'],
                    ['name' => 'Secondary BG', 'var' => '--secondary-bg', 'hex' => '#E6F2FF', 'desc' => '세컨더리 배경색'],
                ];
            @endphp
            
            @foreach($primaryColors as $color)
                <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <div style="height: 120px; background: var({{ $color['var'] }});"></div>
                    <div style="padding: 15px; background: white;">
                        <div style="font-weight: 600; color: #333; margin-bottom: 5px;">{{ $color['name'] }}</div>
                        <div style="font-size: 14px; color: #666; margin-bottom: 5px;">
                            <code style="background: #f5f5f5; padding: 2px 6px; border-radius: 3px;">var({{ $color['var'] }})</code>
                        </div>
                        <div style="font-size: 12px; color: #999;">{{ $color['desc'] }} • {{ $color['hex'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Gray Scale -->
    <div style="margin-bottom: 50px;">
        <h3 style="font-size: 20px; color: #555; margin-bottom: 25px;">Gray Scale</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 15px;">
            @php
                $grayColors = [
                    ['name' => 'Gray 900', 'hex' => '#212121'],
                    ['name' => 'Gray 800', 'hex' => '#424242'],
                    ['name' => 'Gray 700', 'hex' => '#616161'],
                    ['name' => 'Gray 600', 'hex' => '#757575'],
                    ['name' => 'Gray 500', 'hex' => '#9E9E9E'],
                    ['name' => 'Gray 400', 'hex' => '#BDBDBD'],
                    ['name' => 'Gray 300', 'hex' => '#E0E0E0'],
                    ['name' => 'Gray 200', 'hex' => '#EEEEEE'],
                    ['name' => 'Gray 100', 'hex' => '#F5F5F5'],
                    ['name' => 'Gray 50', 'hex' => '#FAFAFA'],
                ];
            @endphp
            
            @foreach($grayColors as $color)
                <div style="text-align: center;">
                    <div style="height: 80px; background: {{ $color['hex'] }}; border-radius: 8px; border: 1px solid #e0e0e0;"></div>
                    <div style="margin-top: 8px;">
                        <div style="font-size: 12px; font-weight: 600; color: #333;">{{ $color['name'] }}</div>
                        <div style="font-size: 11px; color: #666;">{{ $color['hex'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Semantic Colors -->
    <div style="margin-bottom: 50px;">
        <h3 style="font-size: 20px; color: #555; margin-bottom: 25px;">Semantic Colors</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            @php
                $semanticColors = [
                    ['name' => 'Success', 'hex' => '#4CAF50', 'light' => '#C8E6C9', 'desc' => '성공, 완료 상태'],
                    ['name' => 'Warning', 'hex' => '#FF9800', 'light' => '#FFE0B2', 'desc' => '경고, 주의 필요'],
                    ['name' => 'Error', 'hex' => '#F44336', 'light' => '#FFCDD2', 'desc' => '오류, 실패 상태'],
                    ['name' => 'Info', 'hex' => '#2196F3', 'light' => '#BBDEFB', 'desc' => '정보, 안내 메시지'],
                ];
            @endphp
            
            @foreach($semanticColors as $color)
                <div>
                    <div style="display: flex; height: 80px; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <div style="flex: 2; background: {{ $color['hex'] }};"></div>
                        <div style="flex: 1; background: {{ $color['light'] }};"></div>
                    </div>
                    <div style="margin-top: 10px;">
                        <div style="font-weight: 600; color: #333;">{{ $color['name'] }}</div>
                        <div style="font-size: 12px; color: #666;">{{ $color['hex'] }} / {{ $color['light'] }}</div>
                        <div style="font-size: 11px; color: #999; margin-top: 3px;">{{ $color['desc'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Background Colors -->
    <div style="margin-bottom: 50px;">
        <h3 style="font-size: 20px; color: #555; margin-bottom: 25px;">Background Colors</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            @php
                $bgColors = [
                    ['name' => 'Page Background', 'hex' => '#FAFAFA', 'var' => null, 'desc' => '페이지 전체 배경'],
                    ['name' => 'Card Background', 'hex' => '#FFFFFF', 'var' => null, 'desc' => '카드, 컨테이너 배경'],
                    ['name' => 'Hover Background', 'hex' => '#F5F5F5', 'var' => null, 'desc' => '호버 상태 배경'],
                    ['name' => 'Primary Selected BG', 'hex' => '#FFF5F2', 'var' => '--primary-bg', 'desc' => '프라이머리 선택 배경'],
                    ['name' => 'Secondary Selected BG', 'hex' => '#E6F2FF', 'var' => '--secondary-bg', 'desc' => '세컨더리 선택 배경'],
                ];
            @endphp
            
            @foreach($bgColors as $color)
                <div style="border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;">
                    <div style="height: 60px; background: {{ $color['var'] ? 'var(' . $color['var'] . ')' : $color['hex'] }}; border-bottom: 1px solid #e0e0e0;"></div>
                    <div style="padding: 12px; background: white;">
                        <div style="font-weight: 500; color: #333; font-size: 14px;">{{ $color['name'] }}</div>
                        <div style="font-size: 12px; color: #666;">
                            @if($color['var'])
                                <code style="background: #f5f5f5; padding: 2px 6px; border-radius: 3px;">var({{ $color['var'] }})</code> • 
                            @endif
                            {{ $color['hex'] }}
                        </div>
                        <div style="font-size: 11px; color: #999; margin-top: 3px;">{{ $color['desc'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Text Colors -->
    <div style="margin-bottom: 50px;">
        <h3 style="font-size: 20px; color: #555; margin-bottom: 25px;">Text Colors</h3>
        <div style="background: #f8f8f8; padding: 25px; border-radius: 8px;">
            <div style="display: grid; gap: 15px;">
                <div style="font-size: 18px; color: #212121;">
                    <span style="background: white; padding: 5px 10px; border-radius: 4px; margin-right: 10px;">#212121</span>
                    Primary Text - 주요 텍스트에 사용
                </div>
                <div style="font-size: 18px; color: #666666;">
                    <span style="background: white; padding: 5px 10px; border-radius: 4px; margin-right: 10px;">#666666</span>
                    Secondary Text - 보조 텍스트에 사용
                </div>
                <div style="font-size: 18px; color: #999999;">
                    <span style="background: white; padding: 5px 10px; border-radius: 4px; margin-right: 10px;">#999999</span>
                    Disabled Text - 비활성 텍스트에 사용
                </div>
                <div style="font-size: 18px; color: var(--primary-color);">
                    <span style="background: white; padding: 5px 10px; border-radius: 4px; margin-right: 10px;">var(--primary-color)</span>
                    Brand Text - 브랜드 강조 텍스트
                </div>
            </div>
        </div>
    </div>
    
    <!-- Border Colors -->
    <div>
        <h3 style="font-size: 20px; color: #555; margin-bottom: 25px;">Border Colors</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            @php
                $borderColors = [
                    ['name' => 'Default Border', 'hex' => '#E0E0E0', 'var' => null, 'width' => '1px'],
                    ['name' => 'Light Border', 'hex' => '#F0F0F0', 'var' => null, 'width' => '1px'],
                    ['name' => 'Focus Border (Primary)', 'hex' => '#F16341', 'var' => '--primary-color', 'width' => '2px'],
                    ['name' => 'Focus Border (Secondary)', 'hex' => '#007FFF', 'var' => '--secondary-color', 'width' => '2px'],
                    ['name' => 'Error Border', 'hex' => '#F44336', 'var' => null, 'width' => '2px'],
                ];
            @endphp
            
            @foreach($borderColors as $border)
                <div style="padding: 20px; background: white; border: {{ $border['width'] }} solid {{ $border['var'] ? 'var(' . $border['var'] . ')' : $border['hex'] }}; border-radius: 8px;">
                    <div style="font-weight: 500; color: #333;">{{ $border['name'] }}</div>
                    <div style="font-size: 12px; color: #666; margin-top: 5px;">
                        @if($border['var'])
                            <code style="background: #f5f5f5; padding: 2px 6px; border-radius: 3px;">var({{ $border['var'] }})</code> • 
                        @endif
                        {{ $border['hex'] }} / {{ $border['width'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>