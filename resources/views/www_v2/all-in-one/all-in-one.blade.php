@extends('layouts.staging')

@section('title', '공실앤톡 - 스마트한 부동산 솔루션')

@section('content')
<div class="main-v2-container">


        <!-- Client Logos -->
    <section class="section-padding-2" style="padding-top: 90px;">
        <x-v2.text.title-box 
            :subtitle="'맞춤 매물, 무료 공간 컨설팅, 가구•인테리어 세팅뿐만 아니라<br>계약부터 입주까지 한 번에 해결하는 원스톱 솔루션을 만나보세요!'"
            :subtitleHighlight="['']"
            :title="'공실앤톡의<br>ALL-IN-ONE 부동산 솔루션'"
            :subtitlePosition="'bottom'"
            :alignment="'center'"
            :containerClass="'mb-0'"
        />
        
        <x-v2.features.dual-office-showcase 
            :items="[
                [
                    'badges' => ['#매물 상담', '#조건 확인'],
                    'grayText' => '기업 매물 상담',
                    'blackText' => '조건 확인 서비스',
                    'description' => ['기업 또는 임대인의 필요 조건을 빠르게 파악하고,', '최적의 매물 제안을 위한 기본 정보를 수집합니다.'],
                    'mainColor' => '#4A90E2',
                    'subColor' => '#E3F0FF',
                    'leftImage' => '/assets/media/aio/l11.png',
                    'galleryImages' => ['/assets/media/aio/r111.jpg', '/assets/media/aio/r112.jpg', '/assets/media/aio/r113.jpg'],
                    'buttonText' => '매물 상담 시작하기',
                    'buttonLink' => '/consultation'
                ],
                [
                    'badges' => ['#매물 분석', '#빠른 제안'],
                    'grayText' => '매물 조건 분석',
                    'blackText' => '30초 제안서 발송',
                    'description' => ['입력하신 조건을 바탕으로 매물을 분석하고,', '맞춤형 제안서를 30초 안에 발송합니다.'],
                    'mainColor' => '#357ABD',
                    'subColor' => '#D6E9FF',
                    'leftImage' => '/assets/media/aio/l12.png',
                    'galleryImages' => ['/assets/media/aio/r121.jpg', '/assets/media/aio/r122.jpg', '/assets/media/aio/r123.jpg'],
                    'buttonText' => '부동산 구하기',
                    'buttonLink' => '/proposal'
                ]
            ]"
        />
        
        <x-v2.features.dual-office-showcase 
            :items="[
                [
                    'badges' => ['#현장 촬영', '#3D•VR'],
                    'grayText' => '현장 촬영',
                    'blackText' => 'VR/3D 및 고급 촬영',
                    'description' => ['공실•매물의 가치를 극대화하는', '입체적인 VR/3D 및 고해상도 촬영을 제공합니다.'],
                    'mainColor' => '#2E8B57',
                    'subColor' => '#E6F3E8',
                    'leftImage' => '/assets/media/aio/l21.png',
                    'galleryImages' => ['/assets/media/aio/r211.jpg', '/assets/media/aio/r212.jpg', '/assets/media/aio/r213.jpg'],
                    'buttonText' => 'VR/3D 촬영 문의',
                    'buttonLink' => '/vr-shooting'
                ],
                [
                    'badges' => ['#공간 컨설팅', '#맞춤 제안'],
                    'grayText' => '공간 컨설팅',
                    'blackText' => '맞춤 인테리어 제안',
                    'description' => ['전문 컨설턴트가 기업의 업무환경과 예산에 맞춰', '가구•인테리어•공간 배치를 설계합니다.'],
                    'mainColor' => '#FF6B35',
                    'subColor' => '#FFE8D6',
                    'leftImage' => '/assets/media/aio/l22.png',
                    'galleryImages' => ['/assets/media/aio/r113.jpg', '/assets/media/aio/r112.jpg', '/assets/media/aio/r111.jpg'],
                    'buttonText' => '공간 컨설팅 견적 신청',
                    'buttonLink' => '/space-consulting'
                ]
            ]"
        />
        
        <x-v2.features.dual-office-showcase 
            :items="[
                [
                    'badges' => ['#계약 진행', '#조건 협의'],
                    'grayText' => '계약 진행',
                    'blackText' => '안전한 계약 체결',
                    'description' => ['매물 조건과 세부사항을 협의한 뒤', '전문가와 함께 안전하고 신속하게 계약을 체결합니다.'],
                    'mainColor' => '#4A90E2',
                    'subColor' => '#E3F0FF',
                    'leftImage' => '/assets/media/aio/l31.png',
                    'galleryImages' => ['/assets/media/aio/r131.jpg', '/assets/media/aio/r132.jpg', '/assets/media/aio/r133.jpg'],
                    'buttonText' => '계약 진행 문의',
                    'buttonLink' => '/contract'
                ],
                [
                    'badges' => ['#입주 지원', '#운영 관리'],
                    'grayText' => '입주•운영 지원',
                    'blackText' => '정기 청소•관리',
                    'description' => ['입주 전 준비부터 정기 청소, 시설 관리까지', '쾌적하고 효율적인 업무 환경을 유지해 드립니다.'],
                    'mainColor' => '#7B68EE',
                    'subColor' => '#F0EEFF',
                    'leftImage' => '/assets/media/aio/l32.png',
                    'galleryImages' => ['/assets/media/aio/r231.jpg', '/assets/media/aio/r232.jpg', '/assets/media/aio/r233.jpg'],
                    'buttonText' => '운영 관리 문의',
                    'buttonLink' => '/management'
                ]
            ]"
        />
        
        <x-v2.features.dual-office-showcase 
            :items="[
                [
                    'badges' => ['#자산 관리', '#시세 분석'],
                    'grayText' => '자산 관리 리포트',
                    'blackText' => '시세•수익률 분석',
                    'description' => ['매물의 시세 변동과 수익률을 분석하여', '정기 리포트로 발송, 자산 가치를 체계적으로 관리합니다.'],
                    'mainColor' => '#DC3545',
                    'subColor' => '#FFEBEE',
                    'leftImage' => '/assets/media/aio/l41.png',
                    'galleryImages' => ['/assets/media/aio/r141.jpg', '/assets/media/aio/r142.jpg', '/assets/media/aio/r143.jpg'],
                    'buttonText' => '상담 문의',
                    'buttonLink' => '/asset-management',
                    'buttonText2' => '부동산 내놓기',
                    'buttonLink2' => '/asset-management'

                ]
            ]"
        />
    </section>




</div>

<style>
.main-v2-container {
    width: 100%;
    position: relative;
}

.section-padding {
  padding: 180px 50px;
  gap: 60px;
  display: flex;
  flex-direction: column;
}

.section-padding-2 {
  padding: 180px 50px;
  gap: 130px;
  display: flex;
  flex-direction: column;
}

.bg-gray {
    background-color: #FAFAFA;
}

.mb-0 {
    margin-bottom: 0 !important;
}



/* Mobile Responsive */
@media (max-width: 768px) {
    .section-padding {
        padding: 60px 16px;
        gap: 40px;
    }
}

@media (max-width: 480px) {
    .section-padding {
        padding: 40px 16px;
    }

    .section-padding-2 {
        gap: 60px;
        padding:0;
    }
}
</style>
@endsection