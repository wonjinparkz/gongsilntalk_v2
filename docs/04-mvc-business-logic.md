# MVC 패턴 및 비즈니스 로직 문서

## MVC 구조

### Model 계층 (app/Models/)

#### BaseModel 상속 구조
```php
class BaseModel extends Model {
    // 공통 기능: 암호화, 타임스탬프, 소프트 삭제
}

class User extends BaseModel {
    // 사용자 모델
}
```

#### 주요 모델 관계

**User 모델 관계**
```php
// 1:N 관계
hasMany('Product')           // 사용자의 매물
hasMany('Proposal')          // 사용자의 제안서
hasMany('Community')         // 사용자의 커뮤니티 글
hasMany('Reply')             // 사용자의 댓글

// N:M 관계
belongsToMany('User', 'users_follows')  // 팔로우
belongsToMany('User', 'users_blocks')   // 차단
```

**Product 모델 관계**
```php
belongsTo('User')            // 매물 소유자
hasMany('ProductPrice')      // 매물 가격
hasMany('ProductOption')     // 매물 옵션
hasMany('Images')            // 매물 이미지
hasMany('Files')             // 매물 파일
```

### Controller 계층 (app/Http/Controllers/)

#### 컨트롤러 구조
```
Controllers/
├── auth/                    # 인증 관련
│   ├── UserAuthPcController
│   ├── UserAuthAPIController
│   └── PasswordResetController
├── user/                    # 사용자 관련
│   ├── UserController       # 관리자용
│   ├── UserPcController     # PC웹용
│   └── UserAPIController    # 모바일API용
├── product/                 # 매물 관련
│   ├── ProductController
│   ├── ProductPcController
│   └── ProductAPIController
├── community/               # 커뮤니티
├── map/                     # 지도
└── admin/                   # 관리자
```

#### 컨트롤러 명명 규칙
- **{도메인}Controller**: 관리자용
- **{도메인}PcController**: PC 웹용
- **{도메인}APIController**: 모바일 API용

### View 계층 (resources/views/)

#### Blade 템플릿 구조
```
views/
├── layouts/                 # 레이아웃
│   ├── app.blade.php
│   ├── admin.blade.php
│   └── guest.blade.php
├── components/              # 재사용 컴포넌트
├── www/                     # PC 웹 뷰
├── admin/                   # 관리자 뷰
└── exports/                 # 엑셀 내보내기 뷰
```

## 비즈니스 로직 패턴

### 1. 사용자 인증 로직

#### 회원가입 프로세스
```php
1. 이메일/소셜 선택
2. 회원 타입 선택 (일반/중개사)
3. 본인인증 (휴대폰)
4. 정보 입력
5. 중개사의 경우 사업자등록증 첨부
6. 관리자 승인 (중개사만)
```

#### 로그인 프로세스
```php
1. 이메일/비밀번호 또는 소셜 로그인
2. 디바이스 정보 저장 (FCM 키)
3. 자동 로그인 토큰 생성
4. 세션 또는 JWT 토큰 발급
```

### 2. 매물 관리 로직

#### 매물 등록 프로세스
```php
1. 매물 타입 선택 (17가지)
2. 기본 정보 입력
3. 주소 입력 및 좌표 변환
4. 면적 정보 (평 ↔ ㎡ 자동 변환)
5. 가격 정보 (거래 방식별)
6. 옵션 선택
7. 이미지 업로드
8. 관리자 승인 대기
```

#### 매물 상태 관리
```php
State 0: 등록 요청 → 관리자 검토
State 1: 거래중 → 공개 상태
State 2: 거래완료 → 보관
State 3: 비공개 → 임시 숨김
State 4: 등록만료 → 기간 만료
State 5: 등록대기 → 수정 대기
```

### 3. 제안서 생성 로직

#### 일반 제안서
```php
1. 고객 정보 입력
2. 희망 조건 설정
   - 지역, 면적, 가격
   - 업종, 입주시기
3. 매칭 매물 자동 검색
4. 제안서 PDF 생성
5. 공유 링크 생성
```

#### 기업 이전 제안서
```php
1. 기업 정보 입력
2. 이전 요구사항 작성
3. 중개사가 매물 큐레이션
4. 맞춤형 제안서 작성
5. 디자인 템플릿 적용 (5종)
6. PDF 변환 및 공유
```

### 4. 커뮤니티 운영 로직

#### 게시글 관리
```php
1. 카테고리별 작성 (자유글/질문/후기/노하우)
2. 이미지/파일 첨부
3. 조회수 자동 증가
4. 좋아요/스크랩 기능
5. 신고/차단 처리
```

#### 댓글 시스템
```php
1. 계층형 댓글 (대댓글)
2. 실시간 알림
3. 차단 사용자 필터링
4. 신고 누적시 자동 블라인드
```

### 5. 지도 검색 로직

#### 클러스터링
```php
1. 줌 레벨별 그룹핑
2. 밀도 기반 클러스터 생성
3. 대표 마커 표시
4. 클릭시 확대 또는 목록 표시
```

#### 필터링
```php
1. 매물 타입 필터
2. 가격 범위 필터
3. 면적 범위 필터
4. 거래 방식 필터
5. 옵션 필터 (AND/OR 조건)
```

## Helper 클래스 (app/Helper/)

### Commons.php
```php
// 공통 유틸리티 함수
- generateRandomString()     // 랜덤 문자열 생성
- convertAreaUnits()         // 평 ↔ ㎡ 변환
- formatPrice()              // 가격 포맷팅
- getCoordinates()           // 주소 → 좌표 변환
```

### FirebaseService.php
```php
// FCM 푸시 알림
- sendNotification()         // 개별 알림
- sendBatchNotification()    // 일괄 알림
- subscribeTopic()           // 토픽 구독
```

### EncryptCastHelper.php
```php
// 데이터 암호화
- encryptField()            // 필드 암호화
- decryptField()            // 필드 복호화
```

## 데이터 검증 (app/Http/Requests/)

### Request 클래스 예시
```php
class ProductCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type' => 'required|integer|between:0,17',
            'address' => 'required|string|max:255',
            'area' => 'required|numeric|min:0',
            'price' => 'required|integer|min:0',
            'images' => 'required|array|min:1|max:10',
            'images.*' => 'image|max:10240', // 10MB
        ];
    }
    
    public function messages()
    {
        return [
            'type.required' => '매물 타입을 선택해주세요.',
            'area.min' => '면적은 0 이상이어야 합니다.',
        ];
    }
}
```

## 비즈니스 규칙

### 매물 관련
1. 일반 회원: 매물 3개까지 무료
2. 중개사: 무제한 (월 구독)
3. 이미지: 최소 1장, 최대 10장
4. 대표 이미지 필수
5. 30일 후 자동 만료

### 사용자 관련
1. 닉네임 중복 불가
2. 휴대폰 번호 중복 불가
3. 중개사 전환 불가역
4. 탈퇴 후 30일 보관

### 커뮤니티 관련
1. 신고 5회 자동 블라인드
2. 차단 사용자 콘텐츠 숨김
3. 작성자만 수정/삭제
4. 관리자 강제 삭제 가능

## 트랜잭션 처리

### DB 트랜잭션
```php
DB::beginTransaction();
try {
    // 매물 생성
    $product = Product::create($data);
    
    // 가격 정보 저장
    ProductPrice::create([...]);
    
    // 옵션 저장
    ProductOption::insert([...]);
    
    // 이미지 저장
    Images::insert([...]);
    
    DB::commit();
} catch (\Exception $e) {
    DB::rollBack();
    throw $e;
}
```

## 캐싱 전략

### 캐시 키 규칙
```php
'product:list:{type}:{page}'     // 매물 목록
'product:detail:{id}'            // 매물 상세
'user:info:{id}'                 // 사용자 정보
'config:site'                    // 사이트 설정
```

### 캐시 무효화
```php
// 매물 수정시
Cache::forget('product:detail:' . $id);
Cache::tags(['products'])->flush();
```

## 큐 작업 (app/Jobs/)

### 비동기 처리 작업
```php
- SendEmailJob           // 이메일 발송
- ProcessImageJob        // 이미지 리사이징
- GeneratePDFJob         // PDF 생성
- SendNotificationJob    // 푸시 알림
```