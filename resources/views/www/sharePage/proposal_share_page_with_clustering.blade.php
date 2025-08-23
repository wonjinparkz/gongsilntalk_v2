<x-layout>
    <!-- 기존 HTML 구조는 동일 -->
    
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=26c9e58a87bef91e93e2e3e913c91a77&libraries=services,clusterer,drawing"></script>
    <script type="text/javascript" src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpKeyId={{ env('VITE_NAVER_MAP_KEY_ID') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/MarkerClustering.js') }}"></script>
    
    <style>
        /* 클러스터 마커 스타일 */
        .proposal-cluster-marker {
            background: #F16341;
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            border: 2px solid white;
            min-width: 40px;
            text-align: center;
        }
        
        /* 개별 마커 스타일 */
        .marker_default {
            width: 30px;
            height: 43px;
            background: url('/assets/media/map_marker_default.png') no-repeat;
            background-size: contain;
            position: relative;
        }
        
        .marker_default span {
            position: absolute;
            top: 5px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-weight: bold;
            font-size: 14px;
        }
        
        /* 클러스터 InfoWindow 스타일 */
        .cluster-info-window {
            padding: 15px;
            max-width: 250px;
            max-height: 300px;
            overflow-y: auto;
        }
        
        .cluster-info-window h4 {
            margin: 0 0 10px 0;
            color: #333;
            font-size: 16px;
        }
        
        .cluster-info-window .property-item {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }
        
        .cluster-info-window .property-item:hover {
            background: #f5f5f5;
        }
        
        .cluster-info-window .property-item:last-child {
            border-bottom: none;
        }
        
        .property-number {
            display: inline-block;
            background: #F16341;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            text-align: center;
            line-height: 24px;
            margin-right: 8px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>

    <script>
        let map;
        let markers = [];
        let markerCluster;
        let infoWindow;
        let proposalProducts = @json($proposal->products);
        
        // 지도 초기화
        function initMap() {
            map = new naver.maps.Map('map', {
                center: new naver.maps.LatLng('{{ $lat }}', '{{ $lng }}'),
                zoom: 15,
                mapTypeControl: true,
                zoomControl: true,
                zoomControlOptions: {
                    position: naver.maps.Position.TOP_RIGHT
                }
            });
            
            infoWindow = new naver.maps.InfoWindow();
            
            // 마커 생성
            createMarkers();
            
            // 클러스터링 적용
            applyProposalClustering();
            
            // 줌 변경 이벤트
            naver.maps.Event.addListener(map, 'zoom_changed', function() {
                updateMarkerDisplay();
            });
        }
        
        // 마커 생성
        function createMarkers() {
            @foreach ($proposal->products as $key => $product)
                var marker = new naver.maps.Marker({
                    position: new naver.maps.LatLng(
                        '{{ $product->product->address_lat }}',
                        '{{ $product->product->address_lng }}'
                    ),
                    map: map,
                    productIndex: {{ $key + 1 }},
                    productId: {{ $product->product->id }},
                    productType: '{{ $product->product->type_text ?? "매물" }}',
                    productArea: '{{ $product->product->area ?? 0 }}평',
                    productPrice: '{{ $product->product->price_text ?? "가격협의" }}',
                    icon: {
                        content: `<div class="marker_default">
                                    <span>{{ $key + 1 }}</span>
                                  </div>`,
                        size: new naver.maps.Size(30, 43),
                        anchor: new naver.maps.Point(15, 43)
                    }
                });
                
                // 마커 클릭 이벤트
                naver.maps.Event.addListener(marker, 'click', function() {
                    onMarkerClick({{ $key + 1 }});
                });
                
                markers.push(marker);
            @endforeach
        }
        
        // 제안서용 클러스터링 적용
        function applyProposalClustering() {
            // 클러스터 마커 HTML 생성 함수
            var htmlMarker = {
                content: '<div class="proposal-cluster-marker"></div>',
                size: N.Size(40, 40),
                anchor: N.Point(20, 20)
            };
            
            markerCluster = new MarkerClustering({
                minClusterSize: 2, // 2개 이상일 때 클러스터링
                maxZoom: 17, // 줌 레벨 17까지 클러스터링
                map: map,
                markers: markers,
                disableClickZoom: false, // 클릭 시 줌 허용
                gridSize: 60, // 그리드 크기를 작게 해서 민감도 높임
                icons: [htmlMarker],
                indexGenerator: [2, 5, 10, 20], // 클러스터 크기별 스타일
                averageCenter: true, // 평균 중심점 사용
                stylingFunction: function(clusterMarker, count) {
                    // 클러스터에 포함된 마커들의 번호 추출
                    var childMarkers = getClusterMarkers(clusterMarker);
                    var numbers = childMarkers.map(m => m.productIndex).sort((a, b) => a - b);
                    var displayText = numbers.join(', ');
                    
                    // 번호가 많으면 축약 표시
                    if (numbers.length > 5) {
                        displayText = numbers.slice(0, 3).join(', ') + '... (' + count + '개)';
                    }
                    
                    $(clusterMarker.getElement()).find('.proposal-cluster-marker').html(displayText);
                    
                    // 클러스터 클릭 이벤트
                    naver.maps.Event.clearListeners(clusterMarker, 'click');
                    naver.maps.Event.addListener(clusterMarker, 'click', function(e) {
                        showClusterInfo(childMarkers, clusterMarker.getPosition());
                    });
                }
            });
        }
        
        // 클러스터에 포함된 마커 가져오기
        function getClusterMarkers(clusterMarker) {
            // MarkerClustering 내부 구조에 접근
            var clusterer = markerCluster;
            var clusters = clusterer._clusters;
            
            for (var i = 0; i < clusters.length; i++) {
                var cluster = clusters[i];
                if (cluster.getClusterMarker() === clusterMarker) {
                    return cluster.getClusterMember();
                }
            }
            return [];
        }
        
        // 클러스터 정보 창 표시
        function showClusterInfo(markers, position) {
            var content = '<div class="cluster-info-window">';
            content += '<h4>이 위치의 매물 (' + markers.length + '개)</h4>';
            
            markers.sort((a, b) => a.productIndex - b.productIndex).forEach(function(marker) {
                content += '<div class="property-item" onclick="onMarkerClick(' + marker.productIndex + ')">';
                content += '<span class="property-number">' + marker.productIndex + '</span>';
                content += '<span>' + marker.productType + ' / ' + marker.productArea + '</span>';
                content += '<div style="margin-left: 32px; color: #F16341; font-weight: bold;">';
                content += marker.productPrice;
                content += '</div>';
                content += '</div>';
            });
            
            content += '</div>';
            
            infoWindow.setContent(content);
            infoWindow.open(map, position);
        }
        
        // 줌 레벨에 따른 마커 표시 업데이트
        function updateMarkerDisplay() {
            var zoom = map.getZoom();
            
            // 줌 레벨 18 이상에서는 겹친 마커들을 약간 오프셋
            if (zoom >= 18) {
                applyMarkerOffset();
            }
        }
        
        // 겹친 마커들에 오프셋 적용
        function applyMarkerOffset() {
            var threshold = 0.00005; // 약 5미터
            var processedMarkers = [];
            
            markers.forEach(function(marker, i) {
                var pos = marker.getPosition();
                var nearbyMarkers = [];
                
                // 근처 마커 찾기
                markers.forEach(function(otherMarker, j) {
                    if (i !== j && !processedMarkers.includes(j)) {
                        var otherPos = otherMarker.getPosition();
                        var latDiff = Math.abs(pos.lat() - otherPos.lat());
                        var lngDiff = Math.abs(pos.lng() - otherPos.lng());
                        
                        if (latDiff < threshold && lngDiff < threshold) {
                            nearbyMarkers.push(otherMarker);
                        }
                    }
                });
                
                // 근처 마커들이 있으면 원형으로 배치
                if (nearbyMarkers.length > 0) {
                    nearbyMarkers.push(marker);
                    var centerLat = pos.lat();
                    var centerLng = pos.lng();
                    var offset = 0.00003; // 약 3미터
                    
                    nearbyMarkers.forEach(function(m, index) {
                        var angle = (2 * Math.PI * index) / nearbyMarkers.length;
                        var newLat = centerLat + (offset * Math.cos(angle));
                        var newLng = centerLng + (offset * Math.sin(angle));
                        
                        m.setPosition(new naver.maps.LatLng(newLat, newLng));
                        processedMarkers.push(markers.indexOf(m));
                    });
                }
            });
        }
        
        // 마커 클릭 시 스크롤
        function onMarkerClick(index) {
            // 기존 스크롤 기능 유지
            document.getElementById(index + "_product_tr").scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            
            // 해당 행 하이라이트
            $('.product_tr').removeClass('highlighted');
            $('#' + index + '_product_tr').addClass('highlighted');
            
            setTimeout(function() {
                $('#' + index + '_product_tr').removeClass('highlighted');
            }, 2000);
        }
        
        // 페이지 로드 시 지도 초기화
        $(document).ready(function() {
            initMap();
        });
    </script>
    
    <style>
        /* 하이라이트 효과 */
        .product_tr.highlighted {
            background-color: #FFF5F2 !important;
            transition: background-color 0.3s ease;
        }
    </style>
</x-layout>