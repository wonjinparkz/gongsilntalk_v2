@extends('layouts.master')

@section('title', '디자인 시스템 v2')

@section('content')
<div class="design-system-v2-page">
    <!-- Navigation -->
    <div class="design-nav">
        <div class="design-nav-container">
            <h2>디자인 시스템 v2</h2>
            <ul class="design-nav-menu">
                <li><a href="#hero">Hero Sections</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#text">Text Components</a></li>
                <li><a href="#buttons">Buttons</a></li>
                <li><a href="#colors">Colors</a></li>
                <li><a href="#typography">Typography</a></li>
            </ul>
        </div>
    </div>

    <!-- Content -->
    <div class="design-content">
        <!-- Hero Sections -->
        <section id="hero" class="design-section">
            <div class="section-header">
                <h3>Hero Sections</h3>
                <p>메인 페이지 상단에 사용되는 히어로 섹션 컴포넌트</p>
            </div>
            
            <div class="component-demo">
                <h4>Hero Basic</h4>
                <div class="demo-container">
                    <x-v2.hero.hero-basic />
                </div>
                <div class="code-example">
                    <pre><code>&lt;x-v2.hero.hero-basic 
    :mainTitle1="'국내 오피스 \'1위\'"
    :mainTitle2="'패스트파이브 공간을'"
    :mainTitle3="'확인해 보세요'"
    :mainTitle1Bold="['\'1위\'']"
    :mainTitle2Bold="['패스트파이브']"
/&gt;</code></pre>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section id="features" class="design-section">
            <div class="section-header">
                <h3>Features</h3>
                <p>주요 기능을 소개하는 피처 컴포넌트</p>
            </div>
            
            <div class="component-demo">
                <h4>Features Basic</h4>
                <div class="demo-container">
                    <x-v2.features.features-basic />
                </div>
                <div class="code-example">
                    <pre><code>&lt;x-v2.features.features-basic 
    :subtitle="'공실앤톡이 제공하는'"
    :title="'스마트한 부동산 솔루션'"
    :description="'매물 관리부터 고객 상담까지...'"
    :imagePosition="'right'"
/&gt;</code></pre>
                </div>
            </div>

            <div class="component-demo">
                <h4>Feature Cards</h4>
                <div class="demo-container">
                    <x-v2.features.feature-cards />
                </div>
                <div class="code-example">
                    <pre><code>&lt;x-v2.features.feature-cards 
    :cards="$customCards"
/&gt;</code></pre>
                </div>
            </div>

            <div class="component-demo">
                <h4>Client Logos</h4>
                <div class="demo-container">
                    <x-v2.features.client-logos />
                </div>
                <div class="code-example">
                    <pre><code>&lt;x-v2.features.client-logos 
    :animationSpeed="30"
    :logoHeight="60"
/&gt;</code></pre>
                </div>
            </div>
        </section>

        <!-- Text Components -->
        <section id="text" class="design-section">
            <div class="section-header">
                <h3>Text Components</h3>
                <p>텍스트 관련 컴포넌트</p>
            </div>
            
            <div class="component-demo">
                <h4>Title Box</h4>
                <div class="demo-container">
                    <x-v2.text.title-box />
                </div>
                <div class="code-example">
                    <pre><code>&lt;x-v2.text.title-box 
    :subtitle="'공실앤톡이 제공하는'"
    :subtitleHighlight="['공실앤톡']"
    :title="'스마트한 부동산 솔루션'"
    :alignment="'center'"
/&gt;</code></pre>
                </div>
            </div>

            <div class="component-demo">
                <h4>Title Box - Left Aligned</h4>
                <div class="demo-container">
                    <x-v2.text.title-box 
                        :subtitle="'빠르고 정확한 매물 검색'"
                        :subtitleHighlight="['빠르고', '정확한']"
                        :title="'원하는 공간을 찾아드립니다'"
                        :alignment="'left'"
                    />
                </div>
            </div>
        </section>

        <!-- Buttons -->
        <section id="buttons" class="design-section">
            <div class="section-header">
                <h3>Buttons</h3>
                <p>버튼 스타일 가이드</p>
            </div>
            
            <div class="component-demo">
                <h4>Button Sizes</h4>
                <div class="demo-container">
                    <div class="button-grid">
                        <button class="btn btn-xs">Extra Small</button>
                        <button class="btn btn-sm">Small</button>
                        <button class="btn">Default</button>
                        <button class="btn btn-lg">Large</button>
                        <button class="btn btn-xl">Extra Large</button>
                    </div>
                </div>
            </div>

            <div class="component-demo">
                <h4>Button Variants</h4>
                <div class="demo-container">
                    <div class="button-grid">
                        <button class="btn">Default (Secondary)</button>
                        <button class="btn btn-primary">Primary</button>
                        <button class="btn btn-secondary">Secondary</button>
                        <button class="btn btn-danger">Danger</button>
                        <button class="btn btn-warning">Warning</button>
                        <button class="btn btn-success">Success</button>
                        <button class="btn btn-info">Info</button>
                    </div>
                </div>
            </div>

            <div class="component-demo">
                <h4>Outline Buttons</h4>
                <div class="demo-container">
                    <div class="button-grid">
                        <button class="btn btn-outline-primary">Outline Primary</button>
                        <button class="btn btn-outline-secondary">Outline Secondary</button>
                        <button class="btn btn-outline-danger">Outline Danger</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Colors -->
        <section id="colors" class="design-section">
            <div class="section-header">
                <h3>Colors</h3>
                <p>컬러 시스템</p>
            </div>
            
            <div class="component-demo">
                <x-v2.designsystem.colors />
            </div>
        </section>

        <!-- Typography -->
        <section id="typography" class="design-section">
            <div class="section-header">
                <h3>Typography</h3>
                <p>타이포그래피 시스템</p>
            </div>
            
            <div class="component-demo">
                <h4>Headings</h4>
                <div class="demo-container">
                    <h1>h1. Heading 1 (48px)</h1>
                    <h2>h2. Heading 2 (36px)</h2>
                    <h3>h3. Heading 3 (28px)</h3>
                    <h4>h4. Heading 4 (24px)</h4>
                    <h5>h5. Heading 5 (20px)</h5>
                    <h6>h6. Heading 6 (16px)</h6>
                </div>
            </div>

            <div class="component-demo">
                <h4>Body Text</h4>
                <div class="demo-container">
                    <p class="body-t-lg">Large body text (18px)</p>
                    <p class="body-t-md">Medium body text (16px)</p>
                    <p class="body-t-sm">Small body text (14px)</p>
                    <p class="body-t-xs">Extra small body text (12px)</p>
                </div>
            </div>

            <div class="component-demo">
                <h4>Font Weights</h4>
                <div class="demo-container">
                    <p class="fw-300">Light (300)</p>
                    <p class="fw-400">Regular (400)</p>
                    <p class="fw-500">Medium (500)</p>
                    <p class="fw-600">SemiBold (600)</p>
                    <p class="fw-700">Bold (700)</p>
                    <p class="fw-800">ExtraBold (800)</p>
                    <p class="fw-900">Black (900)</p>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
.design-system-v2-page {
    min-height: 100vh;
    background: #f8f8f8;
}

.design-nav {
    position: sticky;
    top: 0;
    background: white;
    border-bottom: 1px solid #e0e0e0;
    z-index: 100;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.design-nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.design-nav h2 {
    font-size: 24px;
    margin-bottom: 16px;
    color: #000;
}

.design-nav-menu {
    display: flex;
    gap: 24px;
    list-style: none;
    padding: 0;
    margin: 0;
    flex-wrap: wrap;
}

.design-nav-menu a {
    color: #666;
    text-decoration: none;
    font-size: 14px;
    padding: 8px 12px;
    border-radius: 4px;
    transition: all 0.2s;
}

.design-nav-menu a:hover {
    background: #f0f0f0;
    color: #000;
}

.design-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

.design-section {
    margin-bottom: 80px;
    scroll-margin-top: 120px;
}

.section-header {
    margin-bottom: 40px;
}

.section-header h3 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 8px;
    color: #000;
}

.section-header p {
    font-size: 16px;
    color: #666;
}

.component-demo {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 32px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.component-demo h4 {
    padding: 20px;
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    border-bottom: 1px solid #e0e0e0;
    background: #fafafa;
}

.demo-container {
    padding: 40px 20px;
    overflow-x: auto;
}

.code-example {
    background: #1e1e1e;
    padding: 20px;
    border-top: 1px solid #e0e0e0;
}

.code-example pre {
    margin: 0;
    overflow-x: auto;
}

.code-example code {
    color: #9cdcfe;
    font-family: 'Monaco', 'Menlo', monospace;
    font-size: 13px;
    line-height: 1.6;
}

.button-grid {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center;
}

/* Mobile responsive */
@media (max-width: 768px) {
    .design-nav-container {
        padding: 16px;
    }
    
    .design-nav h2 {
        font-size: 20px;
    }
    
    .design-nav-menu {
        gap: 12px;
    }
    
    .design-content {
        padding: 20px 16px;
    }
    
    .design-section {
        margin-bottom: 60px;
        scroll-margin-top: 100px;
    }
    
    .section-header h3 {
        font-size: 24px;
    }
    
    .demo-container {
        padding: 20px 16px;
    }
}
</style>
@endsection