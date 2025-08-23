# 프론트엔드 구조 문서

## 기술 스택

### 주요 프레임워크/라이브러리
- **React**: 18.2.0 (SPA 구성)
- **Material-UI**: 5.15.6 (UI 컴포넌트)
- **Vite**: 4.0.0 (빌드 도구)
- **Tailwind CSS**: 3.2.1 (유틸리티 CSS)
- **Axios**: 1.6.4 (HTTP 클라이언트)
- **React Router DOM**: 라우팅
- **Blade Template**: Laravel 뷰 엔진

## 디렉토리 구조

### JavaScript/React (resources/js/)
```
resources/js/
├── web/
│   ├── Web.jsx              # 메인 앱 컴포넌트
│   └── MainScreen.jsx       # 메인 화면
├── components/              # 공통 컴포넌트
│   ├── BottomFooter.jsx
│   ├── BottomMenu.jsx
│   ├── TopMenu.jsx
│   ├── ToolMenu.jsx
│   ├── Icon.jsx
│   ├── IconSet.jsx
│   ├── ColorSet.jsx
│   └── SvgIcons.json       # SVG 아이콘 데이터
├── hook/                    # 커스텀 훅
│   ├── useAlert.jsx
│   ├── useAsync.jsx
│   ├── useFetch.jsx
│   ├── useHistoryState.jsx
│   └── useScript.jsx
├── router/
│   └── Routing.jsx          # 라우팅 설정
└── styles/
    └── theme.jsx            # 테마 설정
```

### CSS/스타일 (public/assets/css/)
```
public/assets/css/
├── reset.css               # 브라우저 리셋
├── common.css              # 공통 스타일
├── common_responsive.css   # 반응형 공통
├── style.css               # 메인 스타일
├── style_responsive.css    # 반응형 메인
├── style.bundle.css        # 번들 스타일
├── user_style.css          # 사용자 정의
└── external.css            # 외부 라이브러리
```

### Blade 템플릿 (resources/views/)
```
resources/views/
├── layouts/                # 레이아웃
├── components/             # 재사용 컴포넌트
├── www/                    # PC 웹 페이지
├── admin/                  # 관리자 페이지
└── m/                      # 모바일 페이지
```

## 컴포넌트 구조

### 레이아웃 컴포넌트
```jsx
// 기본 레이아웃 구조
<AppLayout>
  <TopMenu />           // 상단 메뉴
  <MainContent />       // 메인 콘텐츠
  <BottomFooter />      // 하단 푸터
  <BottomMenu />        // 모바일 하단 메뉴
</AppLayout>
```

### 공통 컴포넌트

#### Icon 컴포넌트
```jsx
// 아이콘 시스템
<Icon name="home" size={24} color="#F16341" />
<IconSet type="option" category="kitchen" />
```

#### ColorSet
```jsx
// 색상 팔레트
const colors = {
  main: '#F16341',      // 메인 컬러
  gray: '#EEEDED',      // 회색
  text: '#2A2828',      // 텍스트
  gray2: '#63605F',     // 보조 회색
  gray3: '#9D9999'      // 연한 회색
}
```

## 스타일 시스템

### CSS 변수 (common.css)
```css
:root {
  --main-color: #F16341;
  --gray-line: #EEEDED;
  --gray-bg: #EEEDED;
  --box-line: #D2D1D0;
  --txt-color: #2A2828;
  --color-gray-2: #63605F;
  --color-gray-3: #9D9999;
}
```

### 폰트 시스템
```css
/* Pretendard 폰트 */
font-family: 'Pretendard', sans-serif;

/* 폰트 굵기 */
font-weight: 100;  /* Thin */
font-weight: 200;  /* ExtraLight */
font-weight: 300;  /* Light */
font-weight: 400;  /* Regular */
font-weight: 500;  /* Medium */
font-weight: 600;  /* SemiBold */
font-weight: 700;  /* Bold */
font-weight: 800;  /* ExtraBold */
font-weight: 900;  /* Black */

/* 레거시 폰트 클래스 */
.txt_r { font-family: 'font-r'; }  /* Regular */
.txt_bold { font-family: 'font-b'; }  /* Bold */
```

### 반응형 브레이크포인트
```css
/* 모바일 */
@media (max-width: 767px) {
  .only_m { display: block; }
  .only_pc { display: none; }
}

/* 태블릿 */
@media (min-width: 768px) and (max-width: 1023px) {
  /* 태블릿 스타일 */
}

/* PC */
@media (min-width: 1024px) {
  .only_m { display: none; }
  .only_pc { display: block; }
}
```

## 커스텀 훅

### useAlert
```jsx
// 알림 메시지 훅
const { showAlert, hideAlert } = useAlert();
showAlert('저장되었습니다', 'success');
```

### useFetch
```jsx
// API 호출 훅
const { data, loading, error } = useFetch('/api/products');
```

### useAsync
```jsx
// 비동기 작업 훅
const { execute, pending, value, error } = useAsync(asyncFunction);
```

### useHistoryState
```jsx
// 브라우저 히스토리 상태 관리
const [state, setState] = useHistoryState('key', initialValue);
```

## 외부 라이브러리

### 지도 (네이버 맵)
```javascript
// 네이버 지도 API
naver.maps.Map
naver.maps.Marker
naver.maps.InfoWindow
MarkerClustering.js  // 마커 클러스터링
```

### 슬라이더 (Swiper)
```javascript
// Swiper 슬라이더
new Swiper('.swiper-container', {
  slidesPerView: 'auto',
  spaceBetween: 20,
  navigation: true,
  pagination: true
});
```

### 에디터 (CKEditor)
```javascript
// CKEditor 5
ClassicEditor.create(element, {
  toolbar: ['heading', 'bold', 'italic', 'link', 'image'],
  language: 'ko'
});
```

### 날짜 선택 (Date Range Picker)
```javascript
// 날짜 범위 선택
$('#daterange').daterangepicker({
  locale: { format: 'YYYY-MM-DD' },
  startDate: moment(),
  endDate: moment().add(7, 'days')
});
```

## 이미지/미디어 자산

### 디렉토리 구조
```
public/assets/
├── media/
│   ├── icons/          # 아이콘 이미지
│   ├── options/        # 옵션 아이콘
│   ├── brands/         # 브랜드 로고
│   └── defaults/       # 기본 이미지
└── fonts/              # 폰트 파일
```

### 이미지 네이밍 규칙
```
btn_*.png          # 버튼
ic_*.png           # 아이콘
option_*_*.png     # 옵션 아이콘
default_*.png      # 기본 이미지
header_*.png       # 헤더 관련
main_*.png         # 메인 페이지
map_*.png          # 지도 관련
```

## 빌드 설정

### Vite 설정 (vite.config.js)
```javascript
export default {
  plugins: [react(), laravel()],
  resolve: {
    alias: {
      '@': '/resources/js',
      '~': '/resources'
    }
  },
  build: {
    outDir: 'public/build',
    manifest: true,
    rollupOptions: {
      input: {
        app: 'resources/js/app.js',
        admin: 'resources/js/admin.js'
      }
    }
  }
}
```

### 번들링 명령어
```bash
# 개발 모드
npm run dev

# 프로덕션 빌드
npm run build

# 감시 모드
npm run watch
```

## 성능 최적화

### 코드 스플리팅
```jsx
// 동적 임포트
const MapComponent = lazy(() => import('./components/Map'));
const AdminPanel = lazy(() => import('./admin/AdminPanel'));
```

### 이미지 최적화
```jsx
// Lazy loading
<img loading="lazy" src="image.jpg" />

// WebP 지원
<picture>
  <source srcset="image.webp" type="image/webp">
  <img src="image.jpg" alt="">
</picture>
```

### 캐싱 전략
```javascript
// Service Worker 캐싱
// LocalStorage 캐싱
localStorage.setItem('user_preferences', JSON.stringify(data));
```

## UI/UX 패턴

### 모달/팝업
```jsx
// 모달 컴포넌트
<Modal open={open} onClose={handleClose}>
  <ModalContent />
</Modal>
```

### 무한 스크롤
```jsx
// IntersectionObserver 활용
const observer = new IntersectionObserver(loadMore);
observer.observe(targetElement);
```

### 스켈레톤 로딩
```jsx
// 로딩 상태 표시
{loading ? <Skeleton /> : <Content />}
```

## 접근성 (A11y)

### ARIA 속성
```html
<button aria-label="메뉴 열기">
<nav role="navigation">
<main role="main">
```

### 키보드 네비게이션
```jsx
// Tab 순서 관리
tabIndex={0}
// Enter/Space 키 처리
onKeyDown={handleKeyDown}
```

## 국제화 (i18n)

### 언어 파일 (resources/lang/ko/)
```php
// 한국어 메시지
'welcome' => '환영합니다',
'login' => '로그인',
'register' => '회원가입'
```