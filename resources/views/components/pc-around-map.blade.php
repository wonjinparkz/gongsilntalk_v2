@props([
    'address_lat' => '',
    'address_lng' => '',
])
<div id="aroundMap" style="width:100%; height:330px" class="size_100p">
</div>
<script>
    // 지도
    var aroundMap = new naver.maps.Map('aroundMap', {
        center: new naver.maps.LatLng('{{ $address_lat }}', '{{ $address_lng }}'),
        zoom: 15
    });

    marker = new naver.maps.Marker({
        position: new naver.maps.LatLng('{{ $address_lat }}', '{{ $address_lng }}'),
        map: aroundMap,
        icon: {
            url: "{{ asset('assets/media/map_marker_default.png') }}",
            size: new naver.maps.Size(100, 100), //아이콘 크기
            scaledSize: new naver.maps.Size(30, 43), //아이콘 크기
            origin: new naver.maps.Point(0, 0),
            anchor: new naver.maps.Point(11, 35)
        }
    });
</script>
