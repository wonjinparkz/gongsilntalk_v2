<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Component: {{ $component }}</title>
    
    <!-- 기존 프로젝트 CSS 로드 -->
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common_responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user_style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style_responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/external.css') }}">
    
    <!-- 외부 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>
    
    <style>
        body {
            padding: 20px;
            background: #ffffff;
            min-height: 100vh;
        }
        
        .component-info {
            background: #f8f8f8;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #F16341;
        }
        
        .component-info h3 {
            color: #333;
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        .component-info .path {
            color: #666;
            font-size: 12px;
            font-family: 'Courier New', monospace;
        }
        
        .component-wrapper {
            padding: 20px;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }
        
        .error-message {
            color: #d32f2f;
            background: #ffebee;
            padding: 15px;
            border-radius: 4px;
            border-left: 4px solid #d32f2f;
        }
    </style>
</head>
<body>
    <div class="component-info">
        <h3>{{ ucfirst($folder) }} / {{ $component }}</h3>
        <div class="path">{{ $componentPath }}</div>
    </div>
    
    <div class="component-wrapper">
        @php
            $viewPath = "components.{$componentPath}";
            $viewExists = view()->exists($viewPath);
        @endphp
        
        @if($viewExists)
            @include($viewPath)
        @else
            <div class="error-message">
                <strong>Component not found:</strong><br>
                View path: {{ $viewPath }}<br>
                Component path: {{ $componentPath }}
            </div>
        @endif
    </div>
    
    <!-- 필요한 JavaScript -->
    <script src="{{ asset('assets/js/swiper.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
</body>
</html>