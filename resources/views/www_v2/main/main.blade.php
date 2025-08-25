@extends('layouts.staging')

@section('title', '공실앤톡 - 스마트한 부동산 솔루션')

@section('content')
<div class="main-v2-container">
    <x-v2.hero.hero-basic/>

    <!-- Title Section -->
    <section class="section-padding" style="background:#F3F6F9;">
        <x-v2.text.title-box 
            :subtitle="'차별화된 부동산 문화, 가치를 높이는 공간 관리로'"
            :subtitleHighlight="['']"
            :title="'임대인과 기업 중심의<br>공간 솔루션을 만들고 있습니다.'"
            :alignment="'center'"
        />

        <!-- Feature Cards -->
        <x-v2.features.feature-cards />
        
        <!-- Centered Button -->
        <div style="text-align: center;">
            <button class="btn btn-secondary">30초 무료 제안서 견적받기</button>
        </div> 
    </section>

        <!-- Client Logos -->
    <section class="section-padding">
        <x-v2.text.title-box 
            :subtitle="'공간앤톡은 1인 사무실부터 200인 이상 대규모 기업까지,<br>모든 규모의 회사에 어울리는 가구•인테리어와 3D 공간 컨설팅을 제공하여'"
            :subtitleHighlight="['1인 사무실부터 200인 이상 대규모 기업']"
            :title="'최적화된 공간 솔루션을 제공합니다'"
            :alignment="'center'"
            :containerClass="'mb-0'"
        />
        <x-v2.features.client-logos />
        <div style="text-align: center; gap:15px; display:flex; justify-content:center;">
            <button class="btn btn-outline-secondary">30초 무료 제안서 견적받기</button> <button class="btn btn-secondary">무료공간컨설팅 견적받기</button>
        </div>
    </section>

            <!-- Gallery Section1 -->
    <section class="section-padding" style="padding: 80px 0 0 0;">
        <x-v2.text.title-box 
            :subtitle="'지식산업센터 분양과 함께 가구•인테리어를 무료로 지원하여<br>계약부터 입주까지 모든 과정을 원스톱으로 해결합니다'"
            :subtitleHighlight="['가구•인테리어를 무료로 지원']"
            :title="'입주 즉시 업무 시작, 완성형 사무실'"
            :alignment="'center'"
            :containerClass="'mb-0'"
        />
        
        <!-- Simple Gallery -->
        <x-v2.gallery.simple-gallery 
            :height="'500px'"
            :imageIndex="1"
        />
    </section>

                <!-- Gallery Section2 -->
    <section class="section-padding" style="text-align: center; background:#F6E8D6; padding: 80px 0;">
        <h2 style="margin:0;">평형별 공간 둘러보기</h2>
        
        <!-- Simple Gallery -->
        <x-v2.gallery.tab-gallery 
            :height="'500px'"
            :imageIndex="1"
        />
                <!-- Centered Button -->
        <div style="text-align: center;">
            <button class="btn btn-secondary">무료 공간컨설팅 견적받기</button>
        </div> 
    </section>

        <!-- Features Section 0 -->
    <section class="section-padding-2" style="text-align: center;">
        <x-v2.text.title-box 
            :subtitle="'공실앤톡과 함께한 성장 이야기'"
            :subtitleHighlight="['']"
            :title="'고객과 함께 만들어온<br>변화와 성과를 확인하세요'"
            :alignment="'center'"
            :containerClass="'mb-0'"
        />

        <x-v2.features.features-basic 
            :subtitle="' '"
            :title="'공톡은<br>11년 동안<br>이렇게<br>성장해 왔어요'"
            :description="' '"
            :textAlign="'center'"
            :imagePosition="'right'"
            :image="'/assets/media/main_page/stat_1.png'"
        />
    </section>

        <!-- Features Section 1 -->
    <section class="section-padding-2" style="text-align: center;">
            <div style="text-align: center; padding: 80px 0 0 0;">
        <h2 style="margin:0;">공실앤톡,<br>공간의 가치를 높이다</h2>
    </div>
        <x-v2.features.features-basic 
            :subtitle="'조건만 알려주세요<br>30초면 충분합니다'"
            :title="'맞춤형 매물 제안서'"
            :description="'실입주 기업이든 사옥을 찾는 기업이든<br>딱 맞는 제안서를 30초 만에 보내드립니다<br>최적의 공간을 빠르게 찾아드립니다'"
            :imagePosition="'left'"
            :image="'/assets/media/auth/bg2.jpg'"
        />

        <x-v2.features.features-basic 
            :subtitle="'실거래가부터 건물 특징까지<br>모든 정보를 한 곳에서'"
            :title="'전국 지식산업센터 정보'"
            :description="'비교와 분석을 단 한 번에 끝냅니다<br>정확한 시장 데이터로 현명한 선택을 도와드립니다<br>실시간 업데이트되는 최신 정보를 제공합니다'"
            :imagePosition="'right'"
            :image="'/assets/media/auth/bg2.jpg'"
        />
    </section>

    <!-- Features Section 2 -->
    <section class="section-padding-2 bg-gray">
        <x-v2.features.features-basic 
            :subtitle="'간단한 정보 입력만으로<br>체계적인 자산 관리'"
            :title="'공실앤톡 자산관리 서비스'"
            :description="'사업자등록증, 임대차계약서를 안전하게 보관합니다<br>자산 가치와 수익률을 한눈에 확인할 수 있습니다<br>맞춤형 리포트로 투자 전략을 수립하세요'"
            :imagePosition="'left'"
            :image="'/assets/media/auth/bg2.jpg'"
        />

        <x-v2.features.features-basic 
            :subtitle="'공실광고 대행과 시세 리포트<br>메타포트 VR·3D 촬영'"
            :title="'공실이 기회로 바뀌는 순간'"
            :description="'현 임대료 시세 리포트로 최적의 전략을 제시합니다<br>전문 촬영으로 매력적인 매물을 만들어드립니다<br>빠른 임대로 공실률을 최소화합니다'"
            :imagePosition="'right'"
            :image="'/assets/media/auth/bg2.jpg'"
        />
    </section>

    <x-v2.features.keyword-features/>

    <section class="section-padding-2" style="text-align: center;">

        <x-v2.features.features-basic 
            :subtitle="'상담 신청부터<br>입주까지 단 하루!'"
            :title="'당일 입주 가능'"
            :description="'공실앤톡은 계약 즉시 바로 쓸 수 있습니다.'"
            :imagePosition="'right'"
            :textAlign="'center'"
            :image="'/assets/media/main_page/in_process.png'"
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
    }
}
</style>
@endsection