<script src="{{ asset('assets/js/common.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">

<!-- map side : s -->

@if ($markerType == 'apt')
    <x-pc-map-side-apt :result="$result" />
@elseif($markerType == 'store')
    <x-pc-map-side-store :result="$result" />
@elseif($markerType == 'building')
    <x-pc-map-side-building :result="$result" />
@elseif($markerType == 'knowledge')
    <x-pc-map-side-knowledge :result="$result" />
@endif
<!-- map side : e -->

<script>
    //공유하기 레이어
    $(".btn_share").click(function() {
        $(".layer_share_wrap").stop().slideToggle(0);
        return false;
    });

    // //페이지 탭
    // var detail_tab = new Swiper(".detail_tab", {
    //     slidesPerView: 'auto',
    //     freeMode: true,
    //     breakpointsInverse: true,
    //     breakpoints: {
    //         1023: {
    //             allowTouchMove: true
    //         }
    //     },
    //     navigation: {
    //         nextEl: ".swiper-button-next",
    //         prevEl: ".swiper-button-prev",
    //     },
    // });

    // //슬라이드 탭
    // function showContent(index) {
    //     console.log('바뀜');
    //     var tabContents = document.querySelectorAll('.side_tab_wrap .sction_item');
    //     tabContents.forEach(function(content) {
    //         content.classList.remove('active');
    //     });
    //     tabContents[index].classList.add('active');
    // }
    // });

    // 페이지 탭
    var detail_tab = new Swiper(".detail_tab", {
        slidesPerView: 'auto',
        freeMode: true,
        breakpointsInverse: true,
        breakpoints: {
            1023: {
                allowTouchMove: true
            }
        },
        navigation: {
            nextEl: ".detail-tab-next",
            prevEl: ".detail-tab-prev",
        },
    });

    // 슬라이드 탭
    function showContent(index) {
        console.log('index : ', index);
        $('.side_tab_wrap .sction_item').removeClass('active');
        $('.side_tab_wrap .sction_item').eq(index).addClass('active');
    }

    // 탭에 클릭 이벤트 추가
    $('.detail_tab .swiper-slide a').on('click', function() {
        var index = $(this).parent().index();
        showContent(index);
    });

    // 컨텐츠 더보기 기능
    $(document).off('click', '.btn_more_open').on('click', '.btn_more_open', function(e) {
        console.log('더보기 누름');
        let box = $(this).prev(); // 클릭한 버튼의 이전 요소(박스) 선택
        let classList = box.attr('class').split(/\s+/); // 박스의 클래스 정보 얻기
        let contentHeight = box.height(); // 박스의 높이 얻기

        if (classList.includes('showstep2')) {
            box.removeClass('showstep2').addClass('showstep1');
            $(this).text('더보기').removeClass('close');
        } else if (classList.includes('showstep1')) {
            box.removeClass('showstep1').addClass('showstep2');
            $(this).text('접기').addClass('close');
        }
    });
</script>
