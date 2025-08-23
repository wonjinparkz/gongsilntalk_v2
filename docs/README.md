# 공실앤톡 프로젝트 기술 문서

이 문서들은 독립 에이전트들이 프로젝트 작업을 수행할 때 참조하기 위한 기술 문서입니다.

## 문서 목록

### 1. [프로젝트 구조](01-project-structure.md)
- 프로젝트 개요 및 기술 스택
- 디렉토리 구조
- 주요 설정 파일
- 네이밍 컨벤션
- 코드 스타일 가이드
- 보안 규칙 및 성능 최적화

### 2. [데이터베이스 스키마](02-database-schema.md)
- 테이블 구조 및 관계
- 컬럼 타입과 제약조건
- 인덱스 전략
- 상태 코드 및 ENUM 값
- 암호화 필드
- 소프트 삭제 정책

### 3. [라우팅 시스템](03-routing-system.md)
- 라우터 파일 구조
- 라우트 네이밍 규칙
- 미들웨어 구조
- RESTful API 규칙
- URL 구조 패턴
- 라우트 파라미터 및 캐싱

### 4. [MVC 패턴 및 비즈니스 로직](04-mvc-business-logic.md)
- Model-View-Controller 구조
- 비즈니스 로직 패턴
- Helper 클래스
- 데이터 검증
- 트랜잭션 처리
- 캐싱 전략

### 5. [프론트엔드 구조](05-frontend-structure.md)
- React/Blade 템플릿 구조
- 컴포넌트 시스템
- 스타일 시스템
- 커스텀 훅
- 외부 라이브러리
- 빌드 설정 및 최적화

### 6. [API 구조](06-api-structure.md)
- API 엔드포인트 구조
- 요청/응답 형식
- 인증 방식
- 에러 코드 체계
- Rate Limiting
- API 보안 및 테스트

## 프로젝트 정보

- **프로젝트명**: PHP 공실앤톡 (Gongsilntalk)
- **도메인**: 부동산 중개 플랫폼
- **주요 기능**: 매물 관리, 제안서 생성, 커뮤니티, 지도 검색
- **기술 스택**: Laravel 10.48.12, React 18.2.0, MySQL
- **리팩토링 시작일**: 2025.08.23

## 작업 시 주의사항

### 코드 작성 규칙
1. PSR-12 PHP 코딩 표준 준수
2. ESLint JavaScript 규칙 준수
3. 기존 코드 패턴 유지
4. 주석은 필요한 경우에만 최소한으로
5. 테스트 코드 작성 권장

### 보안 고려사항
1. 모든 사용자 입력 검증
2. SQL Injection 방지 (Eloquent ORM 사용)
3. XSS 방지 (Blade {{ }} 사용)
4. CSRF 토큰 필수
5. 민감정보 암호화

### 성능 최적화
1. Eager Loading 사용
2. 쿼리 최적화
3. 캐싱 적극 활용
4. 이미지 최적화
5. 코드 스플리팅

### 데이터베이스 작업
1. 마이그레이션 파일 작성
2. 소프트 삭제 사용
3. 트랜잭션 처리
4. 인덱스 고려
5. 외래키 제약 설정

### Git 커밋 규칙
```
[카테고리] 간단한 설명

- 상세 내용 1
- 상세 내용 2

카테고리 예시:
- [기능] 새 기능 추가
- [수정] 버그 수정
- [리팩토링] 코드 개선
- [문서] 문서 업데이트
- [테스트] 테스트 추가/수정
- [설정] 설정 파일 변경
```

## 개발 환경

### 로컬 개발
```bash
# 서버 시작
php artisan serve

# 프론트엔드 개발
npm run dev

# 마이그레이션
php artisan migrate

# 캐시 클리어
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### 프로덕션 배포
```bash
# 최적화
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 프론트엔드 빌드
npm run build

# 마이그레이션
php artisan migrate --force
```

## 문서 업데이트

이 문서들은 프로젝트 변경사항에 따라 지속적으로 업데이트되어야 합니다.
새로운 기능 추가나 구조 변경 시 관련 문서를 즉시 수정해주세요.