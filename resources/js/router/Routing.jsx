import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import MainScreen from "../web/MainScreen";
import Login from "../web/Login";
import NoticeScreen from "../web/notice/NoticeScreen";
import NoticeDetailScreen from "../web/notice/NoticeDetailScreen";
import MapScreen from "../web/map/MapScreen";
import MypageScreen from "../web/my/MypageScreen";

function Routing() {
    return (
        <Routes>
            <Route exact path="/" element={<MainScreen />} />
            <Route path="/login" element={<Login />} />
            {/* 공지사항 */}
            <Route path="/notice" element={<NoticeScreen />} />
            <Route path="/notice/detail" element={<NoticeDetailScreen />} />
            {/* 지도 보기 */}
            <Route path="/map" element={<MapScreen />} />
            {/* 마이페이지 */}
            <Route path="/my" element={<MypageScreen />} />
        </Routes>
    );
}

export default Routing;
