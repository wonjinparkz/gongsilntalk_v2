# 공실앤톡 Design System v2 Overview

## 소개
공실앤톡 디자인 시스템 v2는 일관된 사용자 경험을 제공하기 위한 재사용 가능한 컴포넌트와 스타일 가이드의 모음입니다.

## 주요 특징
- **CSS 변수 기반**: 테마 커스터마이징이 용이한 CSS 변수 시스템
- **Blade 컴포넌트**: Laravel Blade 기반의 재사용 가능한 컴포넌트
- **반응형 디자인**: 모바일 퍼스트 접근 방식
- **AI 친화적 문서화**: AI 에이전트가 쉽게 참조할 수 있는 구조화된 문서

## 디렉토리 구조
```
/var/www/php-gsntalk/
├── resources/views/components/v2/    # v2 컴포넌트
│   ├── hero/                        # 히어로 섹션 컴포넌트
│   ├── features/                    # 기능 소개 컴포넌트
│   ├── text/                        # 텍스트 컴포넌트
│   └── designsystem/                # 디자인 시스템 컴포넌트
├── public/assets/css/               # CSS 파일
│   └── common.css                   # 공통 스타일
└── docs/designsystem/               # 문서화
    ├── typography.md                # 타이포그래피 가이드
    ├── buttons.md                   # 버튼 시스템
    └── [component].md               # 각 컴포넌트 문서
```

## 컴포넌트 목록

### Hero Components
- **hero-basic**: 메인 히어로와 서브 히어로 섹션
  - 735px 고정 높이
  - 선택적 굵은 텍스트 지원
  - 모바일 반응형 그라데이션

### Feature Components
- **features-basic**: 이미지와 텍스트 레이아웃
  - 좌/우 이미지 위치 토글
  - 스크롤 애니메이션 (취소선 효과)
  - 유연한 비율 (텍스트 4.5 : 이미지 5.5)

- **feature-cards**: 5개 카드 레이아웃
  - 4개 컬럼 구조
  - 2번째 컬럼에 2개의 작은 카드
  - 호버 효과와 그림자

### Text Components
- **title-box**: 제목과 부제목 컴포넌트
  - h5 부제목, h3 메인 제목
  - 키워드 하이라이트 효과
  - 정렬 옵션 (left, center, right)

### Design System Components
- **colors**: 컬러 팔레트 표시
- **frame**: 컴포넌트 프레임 래퍼

## 컬러 시스템

### CSS 변수
```css
:root {
    --primary-color: #F16341;
    --secondary-color: #007FFF;
    --btn-primary-color: var(--secondary-color);
    --btn-secondary-color: #000000;
    --danger-color: #dc3545;
    --warning-color: #ffc107;
    --success-color: #28a745;
    --info-color: #17a2b8;
}
```

### 버튼 컬러
- **Primary**: 파란색 (#007FFF)
- **Secondary**: 검은색 (#000000) - 기본값
- **Danger**: 빨간색 (#dc3545)
- **Warning**: 노란색 (#ffc107)
- **Success**: 초록색 (#28a745)
- **Info**: 하늘색 (#17a2b8)

## 타이포그래피

### 헤딩
- h1: 48px, font-weight: 700
- h2: 36px, font-weight: 700
- h3: 28px, font-weight: 700
- h4: 24px, font-weight: 600
- h5: 20px, font-weight: 500
- h6: 16px, font-weight: 500

### 바디 텍스트
- .body-t-lg: 18px
- .body-t-md: 16px (기본)
- .body-t-sm: 14px
- .body-t-xs: 12px

### Font Weights
- .fw-300: Light
- .fw-400: Regular
- .fw-500: Medium
- .fw-600: SemiBold
- .fw-700: Bold
- .fw-800: ExtraBold
- .fw-900: Black

## 반응형 브레이크포인트
- Desktop: > 1024px
- Tablet: 768px - 1024px
- Mobile: 480px - 768px
- Small Mobile: < 480px

## 컴포넌트 사용법

### Blade 컴포넌트 기본 사용
```blade
<x-v2.component-name :prop1="'value1'" :prop2="['array', 'values']" />
```

### Props 전달
- 문자열: `:prop="'string value'"`
- 배열: `:prop="['item1', 'item2']"`
- 변수: `:prop="$variable"`

## 개발 도구

### Component Viewer
URL: `/component-viewer/{component-name}`
- 실시간 컴포넌트 미리보기
- URL 기반 네비게이션
- 프롭 편집 기능

### Design System Page
URL: `/design-system-v2`
- 전체 컴포넌트 갤러리
- 사용 예제와 코드
- 컬러 및 타이포그래피 가이드

## 모범 사례

1. **CSS 변수 사용**: 하드코딩 대신 CSS 변수 사용
2. **컴포넌트 재사용**: 중복 코드 대신 Blade 컴포넌트 활용
3. **반응형 우선**: 모바일 퍼스트 접근 방식
4. **문서화**: 각 컴포넌트에 대한 문서 작성
5. **일관성**: 디자인 시스템 가이드라인 준수

## AI 에이전트를 위한 참고사항

1. 컴포넌트는 `/resources/views/components/v2/` 경로에 위치
2. 각 컴포넌트는 `@props` 디렉티브로 설정 가능
3. 문서는 `/docs/designsystem/` 경로에서 확인
4. CSS는 `/public/assets/css/common.css`에 정의
5. 컴포넌트 사용시 `<x-v2.폴더.컴포넌트명>` 형식 사용