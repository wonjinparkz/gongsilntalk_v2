{{-- 
    Header Component for v2
    Height: 72px
    Max-width: 1920px
    Submenu: Height 300px
--}}

<header class="header-v2">
    <div class="header-container">
        <div class="header-inner">
            {{-- Left Section: Logo + Navigation --}}
            <div class="header-left">
                {{-- Logo --}}
                <div class="header-logo">
                    <a href="/">
                        <img src="/assets/media/header_logo.png" alt="공실앤톡" class="logo-img">
                    </a>
                </div>

                {{-- Main Navigation --}}
                <nav class="header-nav">
                    <ul class="nav-list">
                    <li class="nav-item has-submenu">
                        <a href="#" class="nav-link">부동산서비스</a>
                        <div class="submenu-wrapper">
                            <div class="submenu-inner">
                                <div class="submenu-column">
                                    <ul class="submenu-list">
                                        <li><a href="/map">매물지도</a></li>
                                        <li><a href="/product/register">매물내놓기</a></li>
                                        <li><a href="/product/request">매물구하기</a></li>
                                        <li><a href="/premium-office">프리미엄오피스</a></li>
                                        <li><a href="/office-price">오피스실거래가</a></li>
                                        <li><a href="/all-in-one">부동산올인원서비스</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item has-submenu">
                        <a href="#" class="nav-link">공간맞춤서비스</a>
                        <div class="submenu-wrapper">
                            <div class="submenu-inner">
                                <div class="submenu-column">
                                    <ul class="submenu-list">
                                        <li><a href="/about">공톡소개</a></li>
                                        <li><a href="/furniture">가구컨설팅</a></li>
                                        <li><a href="/interior">인테리어컨설팅</a></li>
                                        <li><a href="/full-floor">전층형오피스</a></li>
                                        <li><a href="/custom-office">맞춤형오피스</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="/management" class="nav-link">공실관리</a>
                    </li>
                    <li class="nav-item">
                        <a href="/field-check" class="nav-link">최저가현장확인</a>
                    </li>
                    <li class="nav-item">
                        <a href="/mypage" class="nav-link">마이페이지</a>
                    </li>
                </ul>
                </nav>
            </div>

            {{-- Right Section: Actions --}}
            <div class="header-actions">
                @auth
                    {{-- Logged in user --}}
                    <div class="user-menu">
                        <button class="user-menu-btn">
                            <span class="user-name">{{ Auth::user()->nickname ?? Auth::user()->name }}</span>
                            <svg class="user-menu-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div class="user-dropdown">
                            <a href="/mypage" class="user-dropdown-item">마이페이지</a>
                            <a href="/mypage/product" class="user-dropdown-item">내 매물 관리</a>
                            <a href="/mypage/proposal" class="user-dropdown-item">받은 제안서</a>
                            <a href="/mypage/settings" class="user-dropdown-item">설정</a>
                            <hr class="user-dropdown-divider">
                            <a href="/logout" class="user-dropdown-item">로그아웃</a>
                        </div>
                    </div>
                    
                    {{-- CTA Button for logged in users --}}
                    <a href="/logout" class="header-cta-btn">로그아웃</a>
                @else
                    {{-- Guest user --}}
                    <div class="header-auth-links">
                        <a href="/login" class="auth-link">로그인</a>
                        <span class="auth-divider">|</span>
                        <a href="/register" class="auth-link">회원가입</a>
                    </div>
                    
                    {{-- CTA Button for guests --}}
                    <a href="/broker/join" class="header-cta-btn">중개사 가입</a>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <button class="mobile-menu-btn" aria-label="메뉴 열기">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>
    </div>
</header>

<style>
/* Header Base Styles */
.header-v2 {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 72px;
    background: #fff;
    border-bottom: 1px solid #E5E5E5;
    z-index: 1000;
    font-family: 'Pretendard', sans-serif;
}

.header-container {
    height: 100%;
    width: 100%;
}

.header-inner {
    max-width: 1920px;
    width: 100%;
    height: 100%;
    margin: 0 auto;
    padding: 0 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-sizing: border-box; /* Include padding in width */
}

/* Left Section */
.header-left {
    display: flex;
    align-items: center;
    gap: 40px;
    flex: 0 0 auto;
}

/* Logo */
.header-logo {
    flex-shrink: 0;
}

.header-logo a {
    display: flex;
    align-items: center;
    height: 40px;
}

.logo-img {
    height: 40px;
    width: auto;
}

/* Navigation */
.header-nav {
    display: flex;
    align-items: center;
}

.nav-list {
    display: flex;
    gap: 48px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-item {
    position: relative;
}

.nav-item.has-submenu {
    position: relative;
}

.nav-link {
    display: flex;
    align-items: center;
    height: 72px;
    padding: 0 4px;
    color: #2A2828;
    font-size: 16px;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.2s;
    position: relative;
}

.nav-link:hover {
    color: var(--primary-color);
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--primary-color);
    transform: scaleX(0);
    transition: transform 0.3s;
}

.nav-item:hover .nav-link::after {
    transform: scaleX(1);
}

/* Submenu */
.submenu-wrapper {
    display: none;
    position: absolute;
    top: 72px;
    left: 0;
    min-width: 222px;
    background: #fff;
    border: 1px solid #E5E5E5;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    z-index: 9999;
}

.nav-item.has-submenu:hover .submenu-wrapper {
    display: block;
}

.submenu-inner {
    padding: 12px 0;
}

.submenu-column {
    width: 222px;
    font-size: 16px;
}

.submenu-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.submenu-list li {
    margin: 0;
}

.submenu-list a {
    display: block;
    padding: 10px 20px;
    color: #63605F;
    font-size: 16px;
    font-weight: 400;
    text-decoration: none;
    transition: all 0.2s;
    white-space: nowrap;
}

.submenu-list a:hover {
    color: var(--primary-color);
    background: #F5F5F5;
}

/* Header Actions */
.header-actions {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-left: auto;
}

/* Auth Links */
.header-auth-links {
    display: flex;
    align-items: center;
    gap: 8px;
}

.auth-link {
    color: #63605F;
    font-size: 16px;
    font-weight: 400;
    text-decoration: none;
    transition: color 0.2s;
}

.auth-link:hover {
    color: var(--primary-color);
}

.auth-divider {
    color: #D2D1D0;
    font-size: 16px;
}

/* CTA Button */
.header-cta-btn {
    min-width: 130px;
    height: 40px;
    padding: 0 16px;
    font-size: 18px;
    font-weight: 600;
    line-height: 170%;
    color: #fff;
    border-radius: 40px;
    background-color: var(--primary-color);
    display: inline-flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    transition: all 0.2s;
    white-space: nowrap;
}

.header-cta-btn:hover {
    background-color: var(--primary-color-dark, #D84315);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(241, 99, 65, 0.3);
}

/* User Menu */
.user-menu {
    position: relative;
}

.user-menu-btn {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 8px 12px;
    background: transparent;
    border: 1px solid #D2D1D0;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
}

.user-menu-btn:hover {
    border-color: var(--primary-color);
}

.user-name {
    font-size: 14px;
    font-weight: 500;
    color: #2A2828;
}

.user-menu-icon {
    color: #63605F;
}

.user-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    min-width: 180px;
    background: #fff;
    border: 1px solid #E5E5E5;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.2s;
}

.user-menu:hover .user-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.user-dropdown-item {
    display: block;
    padding: 12px 16px;
    color: #2A2828;
    font-size: 14px;
    text-decoration: none;
    transition: background 0.2s;
}

.user-dropdown-item:hover {
    background: #F5F5F5;
}

.user-dropdown-divider {
    margin: 8px 0;
    border: none;
    border-top: 1px solid #E5E5E5;
}

/* Mobile Menu Button */
.mobile-menu-btn {
    display: none;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 32px;
    height: 32px;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
}

.hamburger-line {
    width: 24px;
    height: 2px;
    background: #2A2828;
    margin: 3px 0;
    transition: all 0.3s;
    border-radius: 2px;
}

.mobile-menu-btn.active .hamburger-line:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
}

.mobile-menu-btn.active .hamburger-line:nth-child(2) {
    opacity: 0;
}

.mobile-menu-btn.active .hamburger-line:nth-child(3) {
    transform: rotate(-45deg) translate(7px, -6px);
}

/* Responsive */
@media (max-width: 1280px) {
    .nav-list {
        gap: 32px;
    }
    
    .header-inner {
        padding: 0 24px;
    }
}

/* Tablet */
@media (max-width: 1024px) {
    .nav-list {
        gap: 24px;
    }
}

/* Mobile */
@media (max-width: 768px) {
    /* Reset header width for mobile */
    .header-v2 {
        width: 100%;
        height: 60px; /* Slightly smaller on mobile */
    }
    
    .header-container {
        width: 100%;
    }
    
    .header-inner {
        width: 100%;
        max-width: 100%;
        padding: 0 16px;
    }
    
    /* Hide desktop elements */
    .header-nav {
        display: none !important;
    }
    
    .header-actions {
        display: none !important;
    }
    
    /* Show mobile menu button */
    .mobile-menu-btn {
        display: flex;
    }
    
    /* Adjust header left section */
    .header-left {
        flex: 1;
        gap: 0; /* Remove gap on mobile */
    }
    
    /* Adjust logo size for mobile */
    .header-logo {
        flex: 1;
    }
    
    .logo-img {
        height: 32px;
        width: auto;
    }
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Prevent submenu from closing when hovering between menu item and submenu
    const navItems = document.querySelectorAll('.nav-item.has-submenu');
    
    navItems.forEach(item => {
        let hoverTimeout;
        
        item.addEventListener('mouseenter', function() {
            clearTimeout(hoverTimeout);
        });
        
        item.addEventListener('mouseleave', function() {
            hoverTimeout = setTimeout(() => {
                // Submenu will close automatically with CSS
            }, 100);
        });
    });

    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            // Toggle active class for animation
            this.classList.toggle('active');
            
            // Here you can add mobile menu drawer functionality
            // For example, opening a side drawer or dropdown menu
            console.log('Mobile menu toggled');
        });
    }
});
</script>