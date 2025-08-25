@extends('layouts.staging')

@section('title', 'Staging Environment - 공실앤톡 v2')

@section('content')
<div class="staging-index-container">
    <div class="staging-header">
        <h1>공실앤톡 v2 Staging Environment</h1>
        <p>리빌딩 중인 페이지들을 미리 확인할 수 있는 스테이징 환경입니다.</p>
        <div class="staging-notice">
            <strong>⚠️ 주의:</strong> 이 페이지들은 개발 중이며 프로덕션 환경과 다를 수 있습니다.
        </div>
    </div>

    <div class="staging-pages-grid">
        @foreach($pages as $page)
        <a href="{{ route('staging.show', $page['route']) }}" class="staging-page-card">
            <div class="page-card-header">
                <h3>{{ $page['name'] }}</h3>
                <span class="page-route">/staging/{{ $page['route'] }}</span>
            </div>
            <p class="page-description">{{ $page['description'] }}</p>
            <div class="page-status">
                <span class="status-badge">개발 중</span>
            </div>
        </a>
        @endforeach
    </div>
</div>

<style>
.staging-index-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

.staging-header {
    text-align: center;
    margin-bottom: 40px;
}

.staging-header h1 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 16px;
    color: #000;
}

.staging-header p {
    font-size: 18px;
    color: #666;
    margin-bottom: 24px;
}

.staging-notice {
    display: inline-block;
    background: #fff3cd;
    border: 1px solid #ffc107;
    color: #856404;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 14px;
}

.staging-pages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
    margin-bottom: 60px;
}

.staging-page-card {
    display: block;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    padding: 24px;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.staging-page-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    border-color: var(--primary-color);
}

.page-card-header {
    margin-bottom: 12px;
}

.page-card-header h3 {
    font-size: 20px;
    font-weight: 600;
    color: #000;
    margin-bottom: 4px;
}

.page-route {
    font-size: 12px;
    color: #999;
    font-family: 'Monaco', 'Menlo', monospace;
}

.page-description {
    font-size: 14px;
    color: #666;
    line-height: 1.5;
    margin-bottom: 16px;
}

.page-status {
    display: flex;
    gap: 8px;
}

.status-badge {
    display: inline-block;
    padding: 4px 12px;
    background: #28a745;
    color: white;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}

.staging-info {
    background: #f8f9fa;
    padding: 32px;
    border-radius: 12px;
}

.staging-info h2 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 24px;
    color: #000;
}

.info-grid {
    display: grid;
    gap: 16px;
}

.info-item {
    padding: 16px;
    background: white;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
}

.info-item strong {
    display: inline-block;
    margin-right: 12px;
    color: #333;
}

.info-item code {
    background: #f1f1f1;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 13px;
    color: #d73502;
}

@media (max-width: 768px) {
    .staging-pages-grid {
        grid-template-columns: 1fr;
    }
    
    .staging-header h1 {
        font-size: 28px;
    }
    
    .staging-info {
        padding: 24px 16px;
    }
}
</style>
@endsection