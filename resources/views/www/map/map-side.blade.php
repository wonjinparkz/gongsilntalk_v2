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
<script type="text/javascript"
    src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('VITE_NAVER_MAP_CLIENT_ID') }}&submodules=panorama">
</script>

<script>
    window.miniMap = function() {
        miniMap = new naver.maps.Map('minimap', {
            center: new naver.maps.LatLng({{ $result->address_lat }}, {{ $result->address_lng }}),
            // center: new naver.maps.LatLng(37.48860419800877, 126.8880090781063),
            zoom: 17,
            minZoom: 13,
            maxZoom: 20,
            mapTypeId: naver.maps.MapTypeId.NORMAL,
        });
    }

    window.miniMap();

    // 미니맵 좌표
    // naver.maps.Event.addListener(miniMap, 'init', function() {
    //     naver.maps.Event.addListener(miniMap, 'dragend', function() {
    //         var center = miniMap.getCenter();
    //         var zoom = miniMap.getZoom();
    //         console.log('미니맵 : ', zoom);
    //     });
    // });

    function convertCoords(coordString) {
        // 문자열을 공백을 기준으로 분리하여 배열로 변환
        var coordArray = coordString.split(' ');

        // 좌표 쌍으로 묶기 위한 새로운 배열 초기화
        var result = [];

        // 배열을 순회하며 좌표 쌍을 새로운 배열에 추가
        for (var i = 0; i < coordArray.length; i += 2) {
            var x = parseFloat(coordArray[i]);
            var y = parseFloat(coordArray[i + 1]);
            result.push([x, y]);
        }

        return result;
    }

    // 좌표 문자열을 파싱하여 배열로 변환하는 함수
    function convertCoords(coordString) {
        // 좌표 문자열에서 [x, y] 패턴을 추출하여 배열로 변환
        var coordArray = coordString.match(/\[([^\]]+)\]/g).map(function(coord) {
            return coord.replace(/[\[\]]/g, '').split(', ').map(Number);
        });
        return coordArray;
    }

    // 테스트할 좌표 문자열
    var coordsString = "{{ $result->polygon_coordinates ?? '' }}";
    // var coordsString =
    // "[[128.504016804409, 35.229454402980636],[128.50402023824034, 35.22944973015806],[128.50402137300608, 35.22944378602219],[128.5040216235027, 35.22943873958598],[128.50407477383243, 35.22884741301069],[128.50403970768602, 35.22881545187375],[128.5025743354797, 35.22872586850609],[128.50253034621278, 35.22875200615097],[128.50234773001847, 35.229316118859494],[128.50238078371342, 35.22935375058394],[128.50368968758147, 35.22943431068132],[128.50369253525673, 35.229399711198795],[128.50363433396745, 35.229396677746315],[128.50364003321275, 35.22932684786613],[128.50370196811085, 35.229330076933564],[128.50370233012396, 35.229324760556594],[128.50395137690057, 35.22933948454689],[128.50394125680216, 35.22944975711837],[128.504016804409, 35.229454402980636],]";

    if (coordsString != '') {
        // 변환된 좌표 배열
        var convertedCoords = convertCoords(coordsString);

        // 변환된 좌표 리스트 초기화
        var transformedCoords = [];

        // 각 좌표 변환
        $.each(convertedCoords, function(index, coord) {
            transformedCoords.push(new naver.maps.LatLng(coord[1], coord[0]));
        });

        // 폴리곤 그리기
        var polygonMiniMap = new naver.maps.Polygon({
            map: miniMap,
            paths: transformedCoords,
            fillColor: '#ff0000',
            fillOpacity: 0.3,
            strokeColor: '#ff0000',
            strokeOpacity: 0.6,
            strokeWeight: 3
        });

        // 폴리곤 그리기
        polygonMap = new naver.maps.Polygon({
            map: map,
            paths: transformedCoords,
            fillColor: '#ff0000',
            fillOpacity: 0.3,
            strokeColor: '#ff0000',
            strokeOpacity: 0.6,
            strokeWeight: 3
        });

    }

    //공유하기 레이어
    $(".btn_share").click(function() {
        $(".layer_share_wrap").stop().slideToggle(0);
        return false;
    });

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
        $('.side_tab_wrap .sction_item').removeClass('active');
        $('.side_tab_wrap .sction_item').eq(index).addClass('active');
    }

    // 탭에 클릭 이벤트 추가
    $('.detail_tab .swiper-slide').on('click', function() {
        var index = $(this).index();
        showContent(index);
    });

    // 컨텐츠 더보기 기능
    $(document).off('click', '.btn_more_open').on('click', '.btn_more_open', function(e) {
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
