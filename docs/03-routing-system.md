# 라우팅 시스템 문서

## 라우터 파일 구조

### 라우터 파일 목록
- **WebRouter.php**: PC 웹 애플리케이션 라우트
- **ApiRouter.php**: 모바일 API 라우트  
- **AdminRouter.php**: 관리자 백오피스 라우트
- **MobileRouter.php**: 모바일 웹 라우트 (현재 미사용)
- **PartnerRouter.php**: 파트너/협력업체 라우트

## 라우트 네이밍 규칙

### PC 웹 라우트 (WebRouter.php)
```php
// 패턴: www.{도메인}.{액션}
Route::get('/', 'mainView')->name('www.main.main');
Route::get('/map', 'map')->name('www.map.map');
Route::get('/login', 'loginView')->name('www.login.login');
```

### API 라우트 (ApiRouter.php)
```php
// 패턴: api.{버전}.{도메인}.{액션}
Route::post('/login', 'login')->name('api.v1.login');
Route::get('/user/info', 'userInfo')->name('api.v1.user.info');
```

### 관리자 라우트 (AdminRouter.php)
```php
// 패턴: admin.{도메인}.{액션}
Route::get('/login', 'loginView')->name('admin.login.view');
Route::get('/user/list', 'userList')->name('admin.user.list');
```

## 주요 라우트 그룹

### 1. 인증 관련 라우트

#### PC 웹 인증
```php
Route::controller(UserAuthPcController::class)->group(function () {
    // 로그인
    Route::middleware('pc.check')->get('/login', 'loginView');
    Route::post('/login/send', 'login');
    
    // 로그아웃
    Route::middleware('pc.auth')->get('/logout', 'logout');
    
    // 회원가입
    Route::get('/register/register', 'joinView');
    Route::post('/register/send', 'join');
    
    // 소셜 로그인
    Route::get('/sns/kakao', 'kakaoLogin');
    Route::get('/sns/naver', 'naverLogin');
    Route::get('/sns/apple', 'appleLogin');
});
```

#### API 인증
```php
Route::controller(UserAuthAPIController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::post('/register', 'register');
    Route::post('/sns/login', 'snsLogin');
});
```

### 2. 매물 관련 라우트

#### PC 웹 매물
```php
Route::controller(ProductPcController::class)->group(function () {
    Route::middleware('pc.auth')->group(function () {
        // 매물 등록
        Route::get('/product/create', 'productCreateView');
        Route::post('/product/create', 'productCreate');
        
        // 매물 수정
        Route::get('/product/update/{id}', 'productUpdateView');
        Route::post('/product/update/{id}', 'productUpdate');
        
        // 매물 삭제
        Route::delete('/product/delete/{id}', 'productDelete');
    });
});
```

#### 지도 매물
```php
Route::controller(MapPcController::class)->group(function () {
    Route::get('/map', 'map');
    Route::get('/map/property/list', 'mapPropertyList');
    Route::get('/map/room/detail/{id}', 'mapRoomDetail');
    Route::post('/map/marker', 'getMapMarker');
});
```

### 3. 커뮤니티 라우트

```php
Route::controller(CommunityPcController::class)->group(function () {
    // 목록
    Route::get('/community/list', 'communityList');
    Route::get('/community/detail/{id}', 'communityDetail');
    
    // 인증 필요
    Route::middleware('pc.auth')->group(function () {
        Route::get('/community/create', 'communityCreateView');
        Route::post('/community/create', 'communityCreate');
        Route::post('/community/update/{id}', 'communityUpdate');
        Route::delete('/community/delete/{id}', 'communityDelete');
    });
});
```

### 4. 마이페이지 라우트

```php
Route::middleware('pc.auth')->controller(UserPcController::class)->group(function () {
    Route::get('/mypage', 'mypage');
    Route::get('/mypage/profile', 'profile');
    Route::post('/mypage/profile/update', 'profileUpdate');
    Route::get('/mypage/product/list', 'productList');
    Route::get('/mypage/proposal/list', 'proposalList');
    Route::get('/mypage/community/list', 'communityList');
});
```

### 5. 관리자 라우트

```php
Route::middleware('admin.auth')->group(function () {
    // 대시보드
    Route::get('/dashboard', 'dashboard');
    
    // 사용자 관리
    Route::prefix('user')->group(function () {
        Route::get('/list', 'userList');
        Route::get('/detail/{id}', 'userDetail');
        Route::post('/state/update', 'userStateUpdate');
    });
    
    // 매물 관리
    Route::prefix('product')->group(function () {
        Route::get('/list', 'productList');
        Route::get('/detail/{id}', 'productDetail');
        Route::post('/state/update', 'productStateUpdate');
    });
});
```

## 미들웨어 구조

### 인증 미들웨어
- **pc.auth**: PC 웹 사용자 인증 확인
- **pc.check**: PC 웹 비로그인 사용자 체크 (로그인 페이지 접근 제한)
- **admin.auth**: 관리자 인증 확인
- **api.auth**: API 토큰 인증 확인

### 보안 미들웨어
- **throttle**: API 요청 제한 (Rate Limiting)
- **cors**: CORS 정책 적용
- **verified**: 이메일 인증 확인

## RESTful API 규칙

### HTTP 메소드 사용
```php
GET    /api/products       // 목록 조회
GET    /api/products/{id}  // 상세 조회
POST   /api/products       // 생성
PUT    /api/products/{id}  // 수정
DELETE /api/products/{id}  // 삭제
```

### 응답 형식
```json
{
    "success": true,
    "data": {
        // 실제 데이터
    },
    "message": "성공 메시지",
    "code": 200
}
```

### 에러 응답
```json
{
    "success": false,
    "error": {
        "code": "ERROR_CODE",
        "message": "에러 메시지"
    },
    "code": 400
}
```

## URL 구조 패턴

### PC 웹 URL
```
/                           // 메인
/map                        // 지도
/login                      // 로그인
/register                   // 회원가입
/mypage                     // 마이페이지
/community/list             // 커뮤니티 목록
/community/detail/{id}      // 커뮤니티 상세
/product/create             // 매물 등록
/map/room/detail/{id}       // 매물 상세
```

### API URL
```
/api/v1/login               // 로그인
/api/v1/user/info           // 사용자 정보
/api/v1/products            // 매물 목록
/api/v1/products/{id}       // 매물 상세
/api/v1/community           // 커뮤니티
```

### 관리자 URL
```
/admin                      // 관리자 메인
/admin/login                // 관리자 로그인
/admin/dashboard            // 대시보드
/admin/user/list            // 사용자 목록
/admin/product/list         // 매물 목록
```

## 라우트 파라미터

### 필수 파라미터
```php
Route::get('/product/{id}', 'show');  // id는 필수
```

### 선택적 파라미터
```php
Route::get('/products/{category?}', 'index');  // category는 선택적
```

### 정규식 제약
```php
Route::get('/user/{id}', 'show')->where('id', '[0-9]+');  // 숫자만
Route::get('/post/{slug}', 'show')->where('slug', '[A-Za-z-]+');  // 문자와 하이픈만
```

## 라우트 캐싱

### 캐싱 명령어
```bash
# 라우트 캐시 생성
php artisan route:cache

# 라우트 캐시 삭제
php artisan route:clear

# 라우트 목록 확인
php artisan route:list
```

## 보안 고려사항

1. **CSRF 보호**: POST, PUT, DELETE 요청에 CSRF 토큰 필수
2. **인증 확인**: 민감한 작업은 미들웨어로 보호
3. **권한 검증**: 리소스 접근 권한 확인
4. **입력 검증**: Request 클래스로 입력값 검증
5. **Rate Limiting**: API 요청 제한 적용