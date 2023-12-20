import React, { useEffect, useRef } from "react";

function Map() {
    const mapElement = useRef(null);
    const { naver } = window;
    const naverClientId = import.meta.env.VITE_NAVER_MAP_CLIENT_ID;

    useEffect(() => {
        const mapDiv = document.getElementById("map");

        const location = new naver.maps.LatLng(37.5656, 126.9769);
        const mapOptions = {
            center: location, // 중심 좌표
            minZoom: 7, // 최소 줌
            maxZoom: 21, // 최대 줌
            zoom: 17, // 기본 줌
            zoomControl: false, // zoom 컨트롤러
            disableKineticPan: false, // 관성 드래깅 효과
            tileTransition: false, // 타일 fadeIn 효과
        };

        const map = new window.naver.maps.Map(mapDiv, mapOptions);
        // 지도 유형 설정 ("NORMAL" - 일반, "TERRAIN" - 지형도, "SATELLITE" - 위성, "HYBRID" - 하이브리드)
        map.setMapTypeId(naver.maps.MapTypeId["TERRAIN"]);

        const cadastralLayer = new naver.maps.CadastralLayer();
        cadastralLayer.setMap(map);
    }, []);

    return <div id="map" style={{ width: "100%", height: "100vh" }} />;
}

export default Map;
