import { Box, Stack, Toolbar } from "@mui/material";
import React, { useEffect, useRef } from "react";
import TopMenu from "../../components/TopMenu";
import BottomMenu from "../../components/BottomMenu";

export default function MapScreen() {
    const mapElement = useRef(null);
    const { naver } = window;
    const locationBtnHtml = '<a href="#" class="btn"><span class="spr_trff spr_ico_mylct">NAVER 그린팩토리</span></a>';
    const btn_locationBtnHtml = '<div class="btn"><input id="cadastral" type="button" value="지적도 켜기" class="control-btn control-on"></div>'
    const satellite_locationBtnHtml = '<div class="btn"><input id="satellite" type="button" value="위성뷰 켜기" class="control-btn control-on"></div>'
    useEffect(() => {
        const mapDiv = document.getElementById("map");

        const location = new naver.maps.LatLng(37.48569244, 126.89639882);
        const mapOptions = {
            center: location, // 중심 좌표
            minZoom: 7, // 최소 줌
            maxZoom: 21, // 최대 줌
            zoom: 17, // 기본 줌
            zoomControl: false, // zoom 컨트롤러
            disableKineticPan: false, // 관성 드래깅 효과
            tileTransition: false, // 타일 fadeIn 효과
            mapTypeControl: true, // 지도 스타일 변경
            mapTypeControlOptions: {
                style: naver.maps.MapTypeControlStyle.DROPDOWN,
                position: naver.maps.Position.RIGHT_TOP,
            },
            zoomControl: true,
            zoomControlOptions: {
                style: naver.maps.ZoomControlStyle.SMALL,
                position: naver.maps.Position.RIGHT_TOP,
            },
        };

        const map = new window.naver.maps.Map(mapDiv, mapOptions);

        // 지도 유형 설정 ("NORMAL" - 일반, "TERRAIN" - 지형도, "SATELLITE" - 위성, "HYBRID" - 하이브리드)
        map.setMapTypeId(naver.maps.MapTypeId["NORMAL"]);

        const cadastralLayer = new naver.maps.CadastralLayer();

        naver.maps.Event.once(map, 'init', function () {
            cadastralLayer.setMap();
            //customControl 객체 이용하기
            var customControl = new naver.maps.CustomControl(locationBtnHtml, {
                position: naver.maps.Position.RIGHT_TOP
            });
            var btnControl = new naver.maps.CustomControl(btn_locationBtnHtml, {
                position: naver.maps.Position.RIGHT_TOP
            });
            var satelliteControl = new naver.maps.CustomControl(satellite_locationBtnHtml, {
                position: naver.maps.Position.RIGHT_TOP
            });

            btnControl.setMap(map);
            satelliteControl.setMap(map);
            customControl.setMap(map);


            naver.maps.Event.addDOMListener(customControl.getElement(), 'click', function () {
                map.setCenter(new naver.maps.LatLng(37.3595953, 127.1053971));
            });
            naver.maps.Event.addDOMListener(btnControl.getElement(), 'click', function () {
                var cadastral = $('#cadastral');

                if (cadastralLayer.getMap()) {
                    cadastralLayer.setMap(null);
                    cadastral.removeClass("control-on").val("지적도 켜기");
                } else {
                    cadastralLayer.setMap(map);
                    cadastral.addClass("control-on").val("지적도 끄기");
                }
            });
            naver.maps.Event.addDOMListener(satelliteControl.getElement(), 'click', function () {
                var satellite = $('#satellite');
                if (map.getMapTypeId() == 'SATELLITE' || map.getMapTypeId() == 'satellite') {
                    map.setMapTypeId(naver.maps.MapTypeId["NORMAL"]);
                    satellite.removeClass("control-on").val("위성뷰 켜기");
                } else {
                    map.setMapTypeId(naver.maps.MapTypeId["SATELLITE"]);
                    satellite.addClass("control-on").val("위성뷰 끄기");
                }
            });

            //Map 객체의 controls 활용하기
            var $locationBtn = $(locationBtnHtml),
                locationBtnEl = $locationBtn[0];


            naver.maps.Event.addDOMListener(locationBtnEl, 'click', function () {
                map.setCenter(new naver.maps.LatLng(37.3595953, 127.1553971));
            });
        });

        // 폴리곤, 폴리라인 그리기
        // var coordinates = [
        //     { x: 37.48569244, y: 126.89639882 },
        //     { x: 37.48548541, y: 126.89682481 },
        //     { x: 37.48547579, y: 126.89684777 },
        //     { x: 37.48531094, y: 126.89718845 },
        //     { x: 37.48500844, y: 126.89695358 },
        //     { x: 37.48472173, y: 126.89673282 },
        //     { x: 37.48448411, y: 126.89721526 },
        //     { x: 37.48408019, y: 126.89690671 },
        //     { x: 37.48425995, y: 126.8965148 },
        //     { x: 37.48430618, y: 126.89641546 },
        //     { x: 37.48449773, y: 126.89601065 },
        //     { x: 37.48469672, y: 126.89616945 },
        //     { x: 37.48482228, y: 126.8959255 },
        //     { x: 37.48483577, y: 126.89589824 },
        //     { x: 37.48489433, y: 126.89578531 },
        //     { x: 37.48501695, y: 126.89588091 },
        //     { x: 37.48541357, y: 126.89618563 },
        //     { x: 37.48569244, y: 126.89639882 }
        // ];

        // var convertedCoordinates = coordinates.map(function(coord) {
        //     return new naver.maps.LatLng(coord.x, coord.y);
        // });

        // var polygon = new naver.maps.Polygon({
        //     map: map,
        //     paths: [
        //         convertedCoordinates
        //     ],
        //     fillColor: '#ff0000',
        //     fillOpacity: 0.3,
        //     strokeColor: '#ff0000',
        //     strokeOpacity: 0.6,
        //     strokeWeight: 3
        // });


    }, []);
    return (
        <Box
            sx={{
                display: "flex",
                flexDirection: "column",
                height: "100vh",
            }}
        >
            <TopMenu index={1} />

            <Box
                sx={{
                    position: "relative", // 상대적인 위치
                    width: "100vw",
                    height: "100vh",
                    mb: {
                        xs: "50px",
                        md: "0px",
                        lg: "0px",
                    },
                }}
            >
                <Box
                    id="map"
                    ref={mapElement}
                    sx={{
                        width: "100%",
                        height: "100%",
                    }}
                />

            </Box>

            <BottomMenu index={2} />
        </Box>
    );
}
