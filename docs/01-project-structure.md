# 프로젝트 구조 문서

## 프로젝트 개요
- **프로젝트명**: PHP 공실앤톡 (Gongsilntalk)
- **프레임워크**: Laravel 10.48.12
- **PHP 버전**: 8.1+
- **프론트엔드**: React 18.2.0 + Blade Template
- **데이터베이스**: MySQL
- **도메인**: 부동산 중개 플랫폼

## 디렉토리 구조

```
/var/www/php-gsntalk/
├── app/                          # 애플리케이션 코어
│   ├── Console/Commands/         # 스케줄러 명령어
│   ├── Exceptions/               # 예외 핸들러
│   ├── Exports/                  # Excel 내보내기
│   ├── Helper/                   # 헬퍼 클래스
│   ├── Http/                     # HTTP 레이어
│   │   ├── Controllers/          # 컨트롤러
│   │   ├── Middleware/           # 미들웨어
│   │   └── Requests/             # 폼 요청 검증
│   ├── Jobs/                     # 큐 작업
│   ├── Mail/                     # 메일 클래스
│   ├── Models/                   # Eloquent 모델
│   ├── Policies/                 # 권한 정책
│   ├── Providers/                # 서비스 프로바이더
│   └── View/Components/          # View 컴포넌트
├── bootstrap/                    # 부트스트랩 파일
├── config/                       # 설정 파일
├── database/                     # 데이터베이스
│   ├── factories/                # 모델 팩토리
│   ├── migrations/               # 마이그레이션
│   └── seeders/                  # 시더
├── public/                       # 웹 루트
│   └── assets/                   # 정적 자산
│       ├── css/                  # 스타일시트
│       ├── fonts/                # 폰트 파일
│       ├── js/                   # JavaScript
│       └── media/                # 이미지/미디어
├── resources/                    # 리소스 파일
│   ├── css/                      # 원본 CSS
│   ├── js/                       # React/JS 소스
│   ├── lang/                     # 언어 파일
│   ├── sass/                     # SCSS 파일
│   └── views/                    # Blade 뷰
├── routes/                       # 라우팅 파일
├── storage/                      # 스토리지
└── tests/                        # 테스트 파일
```

## 주요 설정 파일

### composer.json 주요 패키지
```json
{
    "laravel/framework": "^10.10",
    "laravel/passport": "^11.10",
    "guzzlehttp/guzzle": "^7.2",
    "intervention/image": "^2.7",
    "maatwebsite/excel": "^3.1",
    "kreait/firebase-php": "^7.6"
}
```

### package.json 주요 패키지
```json
{
    "react": "^18.2.0",
    "react-dom": "^18.2.0",
    "@mui/material": "^5.15.6",
    "axios": "^1.6.4",
    "vite": "^4.0.0",
    "tailwindcss": "^3.2.1"
}
```

## 환경 설정 (.env)
```
APP_NAME="공실앤톡"
APP_ENV=production
APP_KEY=[암호화 키]
APP_DEBUG=false
APP_URL=https://gsntalk.cafe24.com
APP_TIMEZONE=Asia/Seoul
APP_LOCALE=ko

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gsntalk
DB_USERNAME=[사용자명]
DB_PASSWORD=[비밀번호]

MAIL_MAILER=smtp
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

## 네이밍 컨벤션

### 파일명
- **Controller**: PascalCase + Controller (예: ProductController.php)
- **Model**: PascalCase 단수형 (예: User.php, Product.php)
- **Migration**: snake_case + table (예: users_table.php)
- **View**: kebab-case (예: user-profile.blade.php)

### 데이터베이스
- **테이블명**: snake_case 복수형 (예: users, products)
- **컬럼명**: snake_case (예: created_at, user_id)
- **외래키**: 테이블명_id (예: user_id, product_id)

### 라우트
- **Web**: kebab-case (예: /user-profile, /product-list)
- **API**: RESTful 규칙 (예: GET /api/products, POST /api/products)

## 코드 스타일
- **PHP**: PSR-12 표준
- **JavaScript**: ESLint 규칙
- **CSS**: BEM 방법론 + Utility Classes
- **들여쓰기**: 스페이스 4칸 (PHP), 스페이스 2칸 (JS/JSX)

## 보안 규칙
- CSRF 토큰 필수 (POST, PUT, DELETE)
- XSS 방지: Blade의 {{ }} 사용
- SQL Injection 방지: Eloquent ORM 사용
- 민감정보 암호화: phone, company_phone 필드
- API 인증: Laravel Passport OAuth2

## 성능 최적화
- 이미지 최적화: Intervention/Image
- 캐싱: Laravel Cache (file driver)
- 쿼리 최적화: Eager Loading 사용
- 프론트엔드: Vite 번들링, 코드 스플리팅

## 버전 관리
- Git 브랜치: main (운영), develop (개발)
- 커밋 메시지: [카테고리] 설명 형식
- 태그: v1.0.0 형식 (Semantic Versioning)