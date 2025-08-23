# 데이터베이스 스키마 문서

## 테이블 구조

### 1. 사용자 관련 테이블

#### users (사용자)
```sql
- id: bigint(PK)
- provider: string (email/kakao/naver/google/apple)
- email: string(unique)
- password: string(nullable, 암호화)
- token: longText(nullable)
- type: tinyint (0:일반회원, 1:중개사)
- state: tinyint (0:사용가능, 1:사용정지, 2:탈퇴, 3:계약해지)
- name: string
- nickname: string(unique)
- phone: string(unique, 암호화)
- gender: tinyint (0:남자, 1:여자)
- birth: date
- unique_key: string(nullable, 암호화)
- company_state: tinyint (0:승인요청, 1:승인, 2:승인거절)
- company_name: string(nullable)
- company_phone: string(nullable, 암호화)
- company_ceo: string(nullable)
- company_number: string(nullable, 암호화)
- device_type: tinyint (1:Android, 2:iOS, 3:Other)
- fcm_key: string(nullable)
- is_alarm: tinyint(default:1)
- is_marketing: tinyint(default:0)
```

#### admins (관리자)
```sql
- id: bigint(PK)
- admin_id: string(unique)
- admin_pw: string(암호화)
- name: string
- email: string
- state: tinyint (0:이용중, 1:사용중지)
- permission: integer
```

### 2. 매물 관련 테이블

#### product (일반 매물)
```sql
- id: bigint(PK)
- users_id: bigint(FK->users.id)
- product_number: string
- user_type: tinyint (0:일반, 1:중개사)
- state: tinyint (0:등록요청, 1:거래중, 2:거래완료, 3:비공개, 4:등록만료, 5:등록대기)
- type: tinyint (0-17, 매물종류)
- address_lat: double
- address_lng: double
- region_code: string
- region_address: string
- address: string
- address_detail: string(nullable)
- area: double (평)
- square: double (제곱미터)
- exclusive_area: double(nullable)
- exclusive_square: double(nullable)
- floor_number: integer
- total_floor_number: integer
- move_type: tinyint (0:즉시입주, 1:날짜협의, 2:직접입력)
- move_date: date(nullable)
- service_price: bigint(nullable)
- loan_type: tinyint(nullable)
- loan_price: bigint(nullable)
- parking_type: tinyint (0:선택안함, 1:가능, 2:불가능)
```

#### product_price (매물 가격)
```sql
- id: bigint(PK)
- product_id: bigint(FK->product.id)
- payment_type: tinyint (0:매매, 1:임대, 2:단기임대, 3:전세, 4:월세, 5:전매)
- price: bigint
- month_price: bigint(nullable)
- is_rep: tinyint(default:0)
```

#### product_option (매물 옵션)
```sql
- id: bigint(PK)
- product_id: bigint(FK->product.id)
- type: tinyint (1-6, 옵션카테고리)
- sub_type: tinyint (옵션상세)
```

#### corp_product (기업 매물)
```sql
- id: bigint(PK)
- corp_proposal_id: bigint(FK->corp_proposal.id)
- product_type: tinyint (0:상업용, 1:주거용)
- type: tinyint (0-6, 매물종류)
- address_lat: double
- address_lng: double
- address: string
- product_name: string
- exclusive_area: double
- exclusive_square: double
- floor_number: integer
- total_floor_number: integer
- move_type: tinyint
- move_date: date(nullable)
- parking_count: integer
```

#### site_product (분양현장 매물)
```sql
- id: bigint(PK)
- admins_id: bigint(FK->admins.id)
- region_type: tinyint (0-16, 지역)
- address_lat: double
- address_lng: double
- product_name: string
- title: string
- contents: longText
- dong_count: integer
- parking_count: integer
- generation_count: integer
- area: double
- square: double
- floor_area_ratio: double
- building_ratio: double
- completion_date: date
- expected_move_date: date
- developer: string
- construction_company: string
- is_sale: tinyint (0:분양예정, 1:분양중, 2:분양완료)
```

### 3. 제안서 관련 테이블

#### proposal (매물 제안서)
```sql
- id: bigint(PK)
- users_id: bigint(FK->users.id)
- title: string
- type: tinyint (0:상가, 1:지산/사무실/창고, 2:단독공장)
- area: double
- square: double
- business_type: string
- move_type: tinyint
- payment_type: tinyint (0:매매, 1:임대)
- price: bigint
- month_price: bigint(nullable)
- client_name: string
- client_type: tinyint
- interior_type: tinyint
```

#### corp_proposal (기업 이전 제안서)
```sql
- id: bigint(PK)
- users_id: bigint(FK->users.id)
- title: string
- sub_title: string
- company_name: string
- company_address: string
- client_name: string
- client_phone: string
- request_memo: longText
- interior_type: tinyint
- contract_type: tinyint
- payment_type: tinyint
```

### 4. 커뮤니티 관련 테이블

#### community (커뮤니티)
```sql
- id: bigint(PK)
- category: tinyint (0:자유글, 1:질문답변, 2:후기, 3:노하우)
- author: bigint(FK->users.id)
- title: string
- content: longText
- is_blind: tinyint (0:공개, 1:비공개)
- is_delete: tinyint (0:게시중, 1:삭제)
- like_count: integer(default:0)
- view_count: integer(default:0)
```

#### reply (댓글)
```sql
- id: bigint(PK)
- author: bigint(FK->users.id)
- target_type: string (community/magazine)
- target_id: integer
- reply_id: integer(nullable, 대댓글)
- content: longText
- is_blind: tinyint
- is_delete: tinyint
```

#### magazine (매거진)
```sql
- id: bigint(PK)
- type: tinyint (0:공톡유튜브, 1:공톡매거진, 2:공톡뉴스)
- title: string
- content: longText
- url: string(nullable)
- is_blind: tinyint
- is_delete: tinyint
- like_count: integer
- view_count: integer
```

### 5. 부동산 데이터 테이블

#### data_apt (아파트 단지)
```sql
- id: bigint(PK)
- region_code: string
- apt_name: string
- region_address: string
- total_dong_count: integer
- total_generation_count: integer
- generation_type: string
- heating_type: string
- completion_date: date
```

#### data_building (건물)
```sql
- id: bigint(PK)
- region_code: string
- building_name: string
- address: string
- building_type: string
- total_floor: integer
- completion_date: date
```

#### transactions_apt (아파트 실거래)
```sql
- id: bigint(PK)
- unique_code: string(unique)
- data_apt_id: bigint(FK->data_apt.id)
- deal_amount: bigint
- deal_year: integer
- deal_month: integer
- deal_day: integer
- exclusive_area: double
- floor: integer
```

### 6. 파일 관련 테이블

#### files (파일)
```sql
- id: bigint(PK)
- target_type: string
- target_id: integer
- path: string(unique)
- file_type: string
- file_size: bigint
- sort: integer
```

#### images (이미지)
```sql
- id: bigint(PK)
- target_type: string
- target_id: integer
- path: string(unique)
- type: tinyint
- is_rep: tinyint
- sort: integer
```

### 7. 관계 테이블

#### like (좋아요)
```sql
- id: bigint(PK)
- users_id: bigint(FK->users.id)
- target_type: string
- target_id: integer
```

#### users_blocks (사용자 차단)
```sql
- id: bigint(PK)
- users_id: bigint(FK->users.id)
- target_id: bigint(FK->users.id)
```

#### users_follows (사용자 팔로우)
```sql
- id: bigint(PK)
- users_id: bigint(FK->users.id)
- target_id: bigint(FK->users.id)
```

#### recent_product (최근 본 매물)
```sql
- id: bigint(PK)
- users_id: bigint(FK->users.id)
- product_id: bigint(FK->product.id)
```

## 인덱스 전략

### Primary Keys
- 모든 테이블에 id (bigint) 사용
- Auto increment 적용

### Unique Indexes
- users: email, nickname, phone
- admins: admin_id
- files/images: path
- transactions_apt: unique_code

### Foreign Keys
- users_id: 사용자 참조
- product_id: 매물 참조
- target_type + target_id: 다형성 관계

### 검색 최적화 인덱스 (권장)
- product: state, type, region_code
- product: address_lat, address_lng (지도 검색)
- community: category, is_blind, is_delete
- transactions_apt: deal_year, deal_month

## 데이터 타입 규칙

### 문자열
- string: 일반 문자열 (255자)
- longText: 긴 텍스트 (내용, 메모)

### 숫자
- tinyint: 상태값, 타입 (0-255)
- integer: 일반 정수
- bigint: ID, 가격, 큰 숫자
- double: 실수 (좌표, 면적)

### 날짜
- date: 날짜만
- datetime: 날짜+시간
- timestamp: created_at, updated_at

## 암호화 필드
- users.password
- users.phone
- users.company_phone
- users.company_number
- users.unique_key
- admins.admin_pw

## 소프트 삭제
- is_delete 필드 사용
- 0: 정상, 1: 삭제됨
- 실제 DELETE 대신 UPDATE 사용