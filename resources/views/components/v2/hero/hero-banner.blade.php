<div class="hero-banner" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 60px 20px; border-radius: 12px; color: white;">
    <div class="hero-content" style="max-width: 800px; margin: 0 auto; text-align: center;">
        <h1 style="font-size: 48px; font-weight: 700; margin-bottom: 20px;">
            {{ $title ?? '공실앤톡 V2' }}
        </h1>
        <p style="font-size: 20px; opacity: 0.95; margin-bottom: 30px;">
            {{ $subtitle ?? '새로운 부동산 플랫폼의 시작' }}
        </p>
        <div class="hero-buttons" style="display: flex; gap: 15px; justify-content: center;">
            <button class="btn_point btn_lg" style="padding: 12px 30px; font-size: 16px;">
                {{ $primaryButtonText ?? '시작하기' }}
            </button>
            <button class="btn_gray_ghost btn_lg" style="padding: 12px 30px; font-size: 16px; background: white; color: #764ba2;">
                {{ $secondaryButtonText ?? '더 알아보기' }}
            </button>
        </div>
    </div>
</div>