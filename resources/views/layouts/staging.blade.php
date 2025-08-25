<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', '공실앤톡 v2 - Staging')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Additional Styles -->
    @stack('styles')
    
    <!-- Staging Environment Styles -->
    <style>
        .staging-environment {
            padding: 0;
            margin: 0;
            width: 100%;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }
        
        /* Adjust content for fixed header */
        .staging-content-wrapper {
            padding-top: 72px; /* Header height */
            width: 100%;
            box-sizing: border-box;
        }
        
        /* Mobile adjustments */
        @media (max-width: 768px) {
            .staging-content-wrapper {
                padding-top: 60px; /* Mobile header height */
            }
        }
    </style>
</head>
<body class="staging-environment">
    
    {{-- Include v2 Header --}}
    @include('components.v2.header.header')
    
    <!-- Main Content -->
    <div class="staging-content-wrapper">
        @yield('content')
    </div>
    
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Staging Environment Scripts -->
    <script>
        // Toggle Debug Grid with Ctrl+G
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'g') {
                e.preventDefault();
                document.getElementById('debugGrid').classList.toggle('active');
            }
        });
        
        // Console Staging Notice
        console.log('%c🚧 STAGING ENVIRONMENT', 'background: #ffc107; color: #000; padding: 10px 20px; font-size: 16px; font-weight: bold;');
        console.log('%c이 페이지는 개발 중인 v2 버전입니다.', 'color: #666; font-size: 12px;');
        console.log('%cCtrl+G를 눌러 그리드 오버레이를 토글할 수 있습니다.', 'color: #666; font-size: 12px;');
        
        // Add staging class to all links for styling
        document.addEventListener('DOMContentLoaded', function() {
            // Mark internal links that go to staging
            const links = document.querySelectorAll('a[href^="/staging"]');
            links.forEach(link => {
                link.classList.add('staging-link');
                // Add visual indicator for staging links
                if (!link.querySelector('.staging-badge')) {
                    const badge = document.createElement('span');
                    badge.className = 'staging-badge';
                    badge.style.cssText = 'margin-left: 4px; font-size: 10px; color: #ffc107;';
                    badge.textContent = '[v2]';
                    link.appendChild(badge);
                }
            });
        });
        
        // Performance monitoring
        window.addEventListener('load', function() {
            const perfData = performance.getEntriesByType('navigation')[0];
            if (perfData) {
                console.log('%cPage Load Performance:', 'color: #3498db; font-weight: bold;');
                console.table({
                    'DOM Content Loaded': Math.round(perfData.domContentLoadedEventEnd - perfData.domContentLoadedEventStart) + 'ms',
                    'Load Complete': Math.round(perfData.loadEventEnd - perfData.loadEventStart) + 'ms',
                    'Total Load Time': Math.round(perfData.loadEventEnd - perfData.fetchStart) + 'ms'
                });
            }
        });
    </script>
    
    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>