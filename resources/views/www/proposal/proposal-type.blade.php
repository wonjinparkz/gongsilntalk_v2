<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">제안서 미리보기</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">
        <div class="my_inner_wrap">
            <div class="my_wrap">
                <!-- my_side : s -->
                <div class="my_side only_pc">
                    <x-mypage-side :result="$user" />
                </div>
                <!-- my_side : e -->
                <!-- my_body : s -->
                <div class="my_body">
                    <div class="inner_wrap m_inner_wrap">
                        <h1 class="t_center only_pc">제안서 미리보기</h1>
                    </div>
                    <!-- 공유하기 : s -->
                    <div class="relative">
                        <button class="btn_graylight_ghost btn_sm btn_share" data-share="share_entre"><img
                                src="{{ asset('assets/media/header_btn_share_deep.png') }}" class="normal"></button>

                        <div class="layer layer_share_wrap layer_share_top share_entre">
                            <div class="layer_title">
                                <h5>공유하기</h5>
                                <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close btn_share"
                                    data-share="share_entre">
                            </div>
                            <div class="layer_share_con">
                                <a class="kakaotalk-sharing-btn">
                                    <img src="{{ asset('assets/media/share_ic_01.png') }}">
                                    <p class="mt8">카카오톡</p>
                                </a>
                                <a
                                    onclick="textCopy('{{ env('APP_URL') }}/share/corp/proposal/detail?id={{ $corpInfo->id }}&proposal_type=' + $('input[name=proposal_type]:checked').val());$('.md_btn_close').click();">
                                    <img src="{{ asset('assets/media/share_ic_02.png') }}">
                                    <p class="mt8">링크복사</p>
                                </a>
                            </div>
                        </div>

                    </div>
                    <!-- 공유하기 : e -->

                    <div class="proposal_type_wrap">
                        <!-- tab : s -->
                        <div class="swiper proposal_type_tab">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide btn_radioType active">
                                    <input type="radio" name="proposal_type" id="proposal_type_1" value="0"
                                        onclick="showType(this)" checked>
                                    <label for="proposal_type_1">스타일1</label>
                                </div>
                                <div class="swiper-slide btn_radioType">
                                    <input type="radio" name="proposal_type" id="proposal_type_2" value="1"
                                        onclick="showType(this)">
                                    <label for="proposal_type_2">스타일2</label>
                                </div>
                                <div class="swiper-slide btn_radioType">
                                    <input type="radio" name="proposal_type" id="proposal_type_3" value="2"
                                        onclick="showType(this)">
                                    <label for="proposal_type_3">스타일3</label>
                                </div>
                                <div class="swiper-slide btn_radioType">
                                    <input type="radio" name="proposal_type" id="proposal_type_4" value="3"
                                        onclick="showType(this)">
                                    <label for="proposal_type_4">스타일4</label>
                                </div>
                                <div class="swiper-slide btn_radioType">
                                    <input type="radio" name="proposal_type" id="proposal_type_5" value="4"
                                        onclick="showType(this)">
                                    <label for="proposal_type_5">스타일5</label>
                                </div>
                            </div>
                        </div>
                        <!-- tab : e -->

                        <div id="type_preview" class="type_view_wrap">
                            <!-- type_1 : s -->
                            <x-user-proposal-type-1 :corpInfo="$corpInfo" :address="$address" :products="$products" />
                            <!-- type_1 : e -->

                            <!-- type_2 : s -->
                            <x-user-proposal-type-2 :corpInfo="$corpInfo" :address="$address" :products="$products" />
                            <!-- type_2 : e -->

                            <!-- type_3 : s -->
                            <x-user-proposal-type-3 :corpInfo="$corpInfo" :address="$address" :products="$products" />
                            <!-- type_3 : e -->

                            <!-- type_4 : s -->
                            <x-user-proposal-type-4 :corpInfo="$corpInfo" :address="$address" :products="$products" />
                            <!-- type_4 : e -->

                            <!-- type_5 : s -->
                            <x-user-proposal-type-5 :corpInfo="$corpInfo" :address="$address" :products="$products" />
                            <!-- type_5 : e -->
                        </div>

                    </div>
                </div>
                <!-- my_body : e -->

            </div>


        </div>
    </div>

    <script>
        var firstTab = $('.proposal_type_tab input[name="proposal_type"]').first();
        if (firstTab.length) {
            firstTab.prop('checked', true); // 첫 번째 라디오 버튼 선택
            showType(firstTab[0]); // 해당 탭의 내용을 보여주는 함수 호출
        }

        //공유하기 레이어
        $(".btn_share").click(function() {
            var shareLayerClass = $(this).data("share");
            $("." + shareLayerClass).stop().slideToggle(0);
            return;
        });

        var textCopy = (url) => {
            window.navigator.clipboard.writeText(url).then(() => {
                alert("링크가 복사 되었습니다.");
            });
        };

        document.querySelectorAll('.kakaotalk-sharing-btn').forEach(function(button) {
            Kakao.Share.createDefaultButton({
                container: button,
                objectType: "feed",
                content: {
                    title: '{{ $corpInfo->corp_name }} 기업 이전 제안서',
                    description: '{{ $corpInfo->corp_name }} 기업 이전 제안서를 공유드립니다.',
                    imageUrl: "",
                    link: {
                        mobileWebUrl: `{{ env('APP_URL') }}/share/corp/proposal/detail?id={{ $corpInfo->id }}&type=${$('input[name=proposal_type]:checked').val()}`,
                        webUrl: `{{ env('APP_URL') }}/share/corp/proposal/detail?id={{ $corpInfo->id }}&type=${$('input[name=proposal_type]:checked').val()}`,
                    },
                }
            });
        });


        //탭 보기
        function showType(element) {
            var is_checked = element.checked;
            console.log('elment', is_checked);
            if (is_checked) {
                var index = element.value;
                var type_preview = document.querySelectorAll('.type_view_wrap .proposal_type_item');
                type_preview.forEach(function(content) {
                    content.classList.remove('active');
                });
                type_preview[index].classList.add('active');
            }
        }

        //탭 스와이프
        var proposal_type_tab = new Swiper(".proposal_type_tab", {
            slidesPerView: 'auto',
            spaceBetween: 8,
            freeMode: true,
            breakpointsInverse: true,
            breakpoints: {
                1023: {
                    allowTouchMove: false
                }
            }
        });
    </script>

</x-layout>
