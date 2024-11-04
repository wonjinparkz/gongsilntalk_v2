
$(document).ready(function () {
    initTabSwipers(); // 클릭하면 탭 가운데 정렬 함수
    menuScroll(); // 메뉴 클릭 시 스크롤 이동 함수
});

function initTabSwipers() {
    $(".detail_tab").each(function (index) {
        const $container = $(this);

        // 각 탭 스와이프 컨테이너에 클래스를 추가합니다.
        $container.addClass(`detail_tab_${index}`);

        // Swiper 라이브러리를 사용하여 탭 스와이프를 초기화합니다.
        const swiper = new Swiper(`.detail_tab_${index}`, {
            slidesPerView: "auto",
            preventClicks: true,
            preventClicksPropagation: false,
            observer: true, // 슬라이드 변경 관찰 활성화
            observeParents: true // 부모 요소의 변경도 관찰
        });

        // 탭 항목이 클릭 되면 실행할 함수를 연결합니다.
        $container.on('click', '.swiper-slide a', function (e) {
            e.preventDefault();
            const $item = $(this).parent();

            // 클릭 된 항목을 활성 상태로 표시하고 나머지 항목 비활성화
            $container.find('.swiper-slide').removeClass('active');
            $item.addClass('active');

            // 클릭한 항목을 가운데 정렬하는 함수 호출
            centerTabItem($item);
        });

        // 페이지 로드 후에 active 클래스가 있는 항목을 가운데 정렬
        const $activeItem = $container.find('.swiper-slide.active');
        if ($activeItem.length > 0) {
            centerTabItem($activeItem);
        }

        function centerTabItem($target) {
            const $wrapper = $container.find('.swiper-wrapper');
            const targetPos = $target.position();
            const containerWidth = $container.width();
            let newPosition = 0;
            let listWidth = 0;

            // 모든 슬라이드의 너비를 합산하여 리스트 전체 너비 계산
            $wrapper.find('.swiper-slide').each(function () {
                listWidth += $(this).outerWidth();
            });

            // 클릭한 항목을 가운데 정렬하기 위한 위치 계산
            const selectTargetPos = targetPos.left + $target.outerWidth() / 2;
            if (containerWidth < listWidth) {
                if (selectTargetPos <= containerWidth / 2) {
                    newPosition = 0; // 왼쪽
                } else if ((listWidth - selectTargetPos) <= containerWidth / 2) {
                    newPosition = listWidth - containerWidth; // 오른쪽
                } else {
                    newPosition = selectTargetPos - containerWidth / 2;
                }
            }

            // 슬라이드를 새 위치로 이동시키는 애니메이션 설정
            $wrapper.css({
                "transform": `translate3d(${-newPosition}px, 0, 0)`,
                "transition-duration": "500ms"
            });
        }
    });
}

function menuScroll() {
    const $menuWrap = $('.tab_type_2');
    const $menuBox = $menuWrap.find('.detail_tab');
    const $menu = $('.menu');
    const $menuList = $menu.find('div');
    const $menuItems = $menu.find('a')
    const $contents = $('.page');
    const offsetMo = 50; // 메뉴 상단 고정 위치 (모바일)
    const offsetPC = 0;  // 메뉴 상단 고정 위치 (PC)
    const topMo = 80; // 스크롤 했을 때 컨텐츠 시작 위치 (모바일)
    const topPc = 150; // 스크롤 했을 때 컨텐츠 시작 위치 (PC)
    const breakpoints = 767; // 모바일 사이즈 분기점
    let windowWidth = window.innerWidth;
    let isMobile = window.innerWidth < breakpoints;
    let position = $menuWrap.offset().top;
    let resizeTimer;
    let scrollTimer;

    // 메뉴를 고정하는 함수
    function scrollAct() {
        const scrollTop = $(window).scrollTop();
        const offset = isMobile ? offsetMo : offsetPC;
        const menuWrapTop = isMobile ? offsetMo : offsetPC;
        if (scrollTop > position - offset) {
            $menuWrap.css({ 'position': 'fixed', 'top': menuWrapTop + 'px' });
        } else {
            $menuWrap.css({ 'position': 'absolute', 'top': '0' });
        }
    }

    // 활성화된 메뉴 항목을 중앙으로 이동하는 함수
    function activeMenu(target) {
        const targetPos = target.position();
        let pos;
        let listWidth = 0;

        $menu.find('.swiper-slide').each(function () {
            listWidth += $(this).outerWidth();
        });

        const selectTargetPos = targetPos.left + target.outerWidth() / 2;
        if ($menu.outerWidth() < listWidth) {
            const boxHarf = $menuBox.width() / 2;
            if (selectTargetPos <= boxHarf) { // 왼쪽에 위치
                pos = 0;
            } else if ((listWidth - selectTargetPos) <= boxHarf) { // 오른쪽에 위치
                pos = listWidth - $menuBox.width();
            } else {
                pos = selectTargetPos - boxHarf;
            }
        }
        $menu.css({
            "transform": "translate3d(" + (pos * -1) + "px, 0, 0)",
            "transition-duration": "300ms"
        });
    }

    // 창 크기 변경 이벤트 핸들러
    function handleResize() {
        if (windowWidth == window.innerWidth) return;
        $(window).off('scroll', scrollAct);
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            isMobile = window.innerWidth < breakpoints;
            $menuWrap.css({ 'position': 'absolute', 'top': '0' });
            position = $menuWrap.offset().top;
            $(window).on('scroll', scrollAct);
        }, 100);
        windowWidth = window.innerWidth;
    }

    // 스크롤 할 때 메뉴의 활성 상태를 설정하는 함수
    function handleScroll() {
        if (!$('html, body').is(":animated")) {
            const scltop = $(window).scrollTop() + (isMobile ? topMo : topPc);
            if ($(window).scrollTop() + window.innerHeight < $(document).height()) {
                const scltop = $(window).scrollTop() + (isMobile ? topMo : topPc);
                $.each($contents, function (idx, item) {
                    const targetTop = $(this).offset().top;
                    if (targetTop <= scltop) {
                        clearTimeout(scrollTimer);
                        scrollTimer = setTimeout(function () {
                            $menuList.removeClass('active');
                            $menuList.eq(idx).addClass('active');
                            activeMenu($menuList.eq(idx));
                        }, 50);
                    }
                });
            } else { // 맨 아래에 도달하면 마지막 메뉴 항목 활성화
                clearTimeout(scrollTimer);
                scrollTimer = setTimeout(function () {
                    const lastInx = $menuList.length - 1
                    $menuList.removeClass('active');
                    $menuList.eq(lastInx).addClass('active');
                    activeMenu($menuList.eq(lastInx));
                }, 50);
            }
        }
    }

    // 페이지 로드 시 초기화 작업
    $(window).on('load', function () {
        $(window).on('scroll', scrollAct).scroll();
    });

    // 창 크기 변경 이벤트 및 스크롤 이벤트 핸들러 등록
    $(window).on('resize', handleResize);
    $(window).scroll(handleScroll);

    // 메뉴 클릭 이벤트 핸들러 등록
    $menuItems.on('click', function (e) {
        e.preventDefault();
        const gnbHash = $(this).attr('href');
        const offset = $(gnbHash).offset().top - (isMobile ? topMo - 1 : topPc - 1);
        $('html, body').animate({ scrollTop: offset }, 500);
        $(this).closest('div').addClass('active').siblings().removeClass('active');
    });
}

