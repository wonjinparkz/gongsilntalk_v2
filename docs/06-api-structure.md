# API 구조 문서

## API 버전 관리

### 버전 체계
- **v1**: 현재 운영 버전 (/api/v1/)
- 버전별 라우트 그룹 분리
- 하위 호환성 유지

## API 엔드포인트 구조

### 인증 API

#### 로그인/회원가입
```
POST   /api/v1/login                 # 로그인
POST   /api/v1/logout                # 로그아웃
POST   /api/v1/register              # 회원가입
POST   /api/v1/sns/login             # 소셜 로그인
POST   /api/v1/password/reset        # 비밀번호 재설정
POST   /api/v1/password/change       # 비밀번호 변경
```

#### 토큰 관리
```
POST   /api/v1/token/refresh         # 토큰 갱신
POST   /api/v1/token/verify          # 토큰 검증
```

### 사용자 API

#### 프로필 관리
```
GET    /api/v1/user/info             # 내 정보 조회
PUT    /api/v1/user/profile          # 프로필 수정
DELETE /api/v1/user/withdraw         # 회원 탈퇴
POST   /api/v1/user/device           # 디바이스 정보 등록
```

#### 중개사 정보
```
POST   /api/v1/user/company/request  # 중개사 승인 요청
GET    /api/v1/user/company/status   # 승인 상태 확인
PUT    /api/v1/user/company/update   # 중개사 정보 수정
```

### 매물 API

#### CRUD 작업
```
GET    /api/v1/products              # 매물 목록
GET    /api/v1/products/{id}         # 매물 상세
POST   /api/v1/products              # 매물 등록
PUT    /api/v1/products/{id}         # 매물 수정
DELETE /api/v1/products/{id}         # 매물 삭제
```

#### 매물 검색/필터
```
GET    /api/v1/products/search       # 매물 검색
GET    /api/v1/products/filter       # 매물 필터링
GET    /api/v1/products/map          # 지도 매물
GET    /api/v1/products/nearby       # 주변 매물
```

#### 매물 액션
```
POST   /api/v1/products/{id}/like    # 좋아요
DELETE /api/v1/products/{id}/like    # 좋아요 취소
POST   /api/v1/products/{id}/view    # 조회수 증가
POST   /api/v1/products/{id}/report  # 신고
```

### 커뮤니티 API

#### 게시글
```
GET    /api/v1/community             # 게시글 목록
GET    /api/v1/community/{id}        # 게시글 상세
POST   /api/v1/community             # 게시글 작성
PUT    /api/v1/community/{id}        # 게시글 수정
DELETE /api/v1/community/{id}        # 게시글 삭제
```

#### 댓글
```
GET    /api/v1/community/{id}/replies      # 댓글 목록
POST   /api/v1/community/{id}/replies      # 댓글 작성
PUT    /api/v1/replies/{id}                # 댓글 수정
DELETE /api/v1/replies/{id}                # 댓글 삭제
```

### 제안서 API

#### 일반 제안서
```
GET    /api/v1/proposals             # 제안서 목록
GET    /api/v1/proposals/{id}        # 제안서 상세
POST   /api/v1/proposals             # 제안서 생성
PUT    /api/v1/proposals/{id}        # 제안서 수정
DELETE /api/v1/proposals/{id}        # 제안서 삭제
GET    /api/v1/proposals/{id}/pdf    # PDF 다운로드
```

#### 기업 제안서
```
GET    /api/v1/corp-proposals        # 기업 제안서 목록
POST   /api/v1/corp-proposals        # 기업 제안서 생성
GET    /api/v1/corp-proposals/{id}   # 기업 제안서 상세
```

### 알림 API

```
GET    /api/v1/notifications         # 알림 목록
PUT    /api/v1/notifications/read    # 알림 읽음 처리
DELETE /api/v1/notifications/{id}    # 알림 삭제
POST   /api/v1/notifications/token   # FCM 토큰 등록
```

### 파일 업로드 API

```
POST   /api/v1/upload/image          # 이미지 업로드
POST   /api/v1/upload/file           # 파일 업로드
DELETE /api/v1/upload/{id}           # 파일 삭제
```

## 요청/응답 형식

### 요청 헤더
```http
Content-Type: application/json
Accept: application/json
Authorization: Bearer {token}
X-Device-Type: iOS|Android
X-App-Version: 1.0.0
```

### 성공 응답
```json
{
    "success": true,
    "data": {
        // 실제 데이터
    },
    "message": "성공",
    "code": 200
}
```

### 페이지네이션 응답
```json
{
    "success": true,
    "data": {
        "items": [...],
        "pagination": {
            "current_page": 1,
            "last_page": 10,
            "per_page": 20,
            "total": 200
        }
    }
}
```

### 에러 응답
```json
{
    "success": false,
    "error": {
        "code": "VALIDATION_ERROR",
        "message": "유효성 검사 실패",
        "details": {
            "email": ["이메일 형식이 올바르지 않습니다."],
            "password": ["비밀번호는 8자 이상이어야 합니다."]
        }
    },
    "code": 422
}
```

## HTTP 상태 코드

### 성공 코드
- **200 OK**: 요청 성공
- **201 Created**: 리소스 생성 성공
- **204 No Content**: 삭제 성공

### 클라이언트 에러
- **400 Bad Request**: 잘못된 요청
- **401 Unauthorized**: 인증 필요
- **403 Forbidden**: 권한 없음
- **404 Not Found**: 리소스 없음
- **422 Unprocessable Entity**: 유효성 검사 실패
- **429 Too Many Requests**: 요청 제한 초과

### 서버 에러
- **500 Internal Server Error**: 서버 내부 오류
- **503 Service Unavailable**: 서비스 이용 불가

## 인증 방식

### JWT 토큰
```json
{
    "token_type": "Bearer",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "refresh_token": "def50200b3f7c3f3c3f...",
    "expires_in": 3600
}
```

### 토큰 갱신
```javascript
// Access Token 만료시 Refresh Token으로 갱신
POST /api/v1/token/refresh
{
    "refresh_token": "def50200b3f7c3f3c3f..."
}
```

## 에러 코드 체계

### 인증 관련
```
AUTH_001: 로그인 실패
AUTH_002: 토큰 만료
AUTH_003: 유효하지 않은 토큰
AUTH_004: 권한 없음
```

### 사용자 관련
```
USER_001: 사용자를 찾을 수 없음
USER_002: 이미 존재하는 이메일
USER_003: 이미 존재하는 닉네임
USER_004: 비밀번호 불일치
```

### 매물 관련
```
PRODUCT_001: 매물을 찾을 수 없음
PRODUCT_002: 매물 등록 제한 초과
PRODUCT_003: 수정 권한 없음
PRODUCT_004: 이미 거래 완료된 매물
```

### 시스템 관련
```
SYS_001: 서버 내부 오류
SYS_002: 데이터베이스 연결 실패
SYS_003: 외부 서비스 연동 실패
```

## API 제한 (Rate Limiting)

### 제한 정책
```php
// 일반 API: 분당 60회
Route::middleware('throttle:60,1')->group(function () {
    // API 라우트
});

// 인증 API: 분당 10회
Route::middleware('throttle:10,1')->group(function () {
    Route::post('/login');
    Route::post('/register');
});

// 파일 업로드: 분당 10회
Route::middleware('throttle:10,1')->group(function () {
    Route::post('/upload');
});
```

### Rate Limit 헤더
```http
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 45
X-RateLimit-Reset: 1640995200
```

## API 보안

### CORS 설정
```php
// config/cors.php
'allowed_origins' => ['https://app.gsntalk.com'],
'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'],
'allowed_headers' => ['Content-Type', 'Authorization'],
```

### 입력 검증
```php
// Request 클래스 사용
public function rules()
{
    return [
        'email' => 'required|email',
        'password' => 'required|min:8',
        'phone' => 'required|regex:/^01[0-9]{8,9}$/'
    ];
}
```

### SQL Injection 방지
```php
// Eloquent ORM 사용
Product::where('type', $type)->get();

// 파라미터 바인딩
DB::select('SELECT * FROM products WHERE type = ?', [$type]);
```

## API 문서화

### OpenAPI (Swagger) 스펙
```yaml
openapi: 3.0.0
info:
  title: 공실앤톡 API
  version: 1.0.0
  description: 부동산 중개 플랫폼 API
servers:
  - url: https://api.gsntalk.com/v1
paths:
  /login:
    post:
      summary: 사용자 로그인
      requestBody:
        required: true
        content:
          application/json:
            schema:
              type: object
              properties:
                email:
                  type: string
                password:
                  type: string
```

## 웹훅 시스템

### 이벤트 알림
```php
// 매물 상태 변경 웹훅
POST https://partner.example.com/webhook
{
    "event": "product.status.changed",
    "data": {
        "product_id": 123,
        "old_status": 1,
        "new_status": 2
    },
    "timestamp": "2024-01-01T00:00:00Z"
}
```

## API 테스트

### Postman Collection
```json
{
    "name": "공실앤톡 API",
    "requests": [
        {
            "name": "로그인",
            "method": "POST",
            "url": "{{base_url}}/login",
            "body": {
                "email": "{{email}}",
                "password": "{{password}}"
            }
        }
    ]
}
```

### 자동화 테스트
```php
// PHPUnit 테스트
public function testLogin()
{
    $response = $this->postJson('/api/v1/login', [
        'email' => 'test@example.com',
        'password' => 'password123'
    ]);
    
    $response->assertStatus(200)
             ->assertJsonStructure(['success', 'data', 'token']);
}
```