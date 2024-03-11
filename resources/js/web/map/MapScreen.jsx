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

        function parseCoordinates(data) {
            const coordinatesList = [];
            const points = data.split(' ');

            for (const point of points) {
                const [y, x] = point.split(',').map(Number);
                coordinatesList.push({ x, y });
            }

            return coordinatesList;
        }

        // 폴리곤, 폴리라인 그리기
        var coordinates = parseCoordinates("126.88228333,37.47856255 126.88234593,37.47842135 126.8824955,37.47808293 126.88252174,37.47802573 126.88253251,37.47800114 126.88255723,37.47794384 126.88252518,37.47793198 126.88249253,37.47792426 126.88233677,37.47787998 126.88215995,37.47782976 126.88200088,37.47778463 126.88182126,37.47773341 126.88159348,37.47766873 126.88143861,37.4776247 126.88141996,37.47761914 126.88133063,37.47759358 126.88120798,37.47755818 126.88111992,37.47753322 126.88112591,37.47756224 126.88108818,37.47764878 126.8810472,37.47774194 126.88103,37.47777969 126.8809795,37.47789573 126.88094265,37.47797978 126.88089802,37.47808026 126.88086213,37.47816201 126.88122322,37.47825973 126.88117743,37.4783654 126.88115343,37.47841925 126.88112813,37.47847677 126.88145033,37.4785655 126.88182525,37.47866894 126.88219102,37.47876972 126.88219626,37.47875943 126.88228333,37.47856255")

        // var coordinates = [
        //     {x: 37.50067135, y: 126.8878978},
        //     {x: 37.50058798, y: 126.88796623},
        //     {x: 37.50050638, y: 126.88780939},
        //     {x: 37.50059002, y: 126.88774095},
        //     {x: 37.50067135, y: 126.8878978},
        // ]



        var convertedCoordinates = coordinates.map(function(coord) {
            return new naver.maps.LatLng(coord.x, coord.y);
        });

        var polygon = new naver.maps.Polygon({
            map: map,
            paths: [
                convertedCoordinates
            ],
            fillColor: '#ff0000',
            fillOpacity: 0.3,
            strokeColor: '#ff0000',
            strokeOpacity: 0.6,
            strokeWeight: 3
        });


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
