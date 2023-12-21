import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import MainScreen from "../web/MainScreen";
import NoticeScreen from "../web/notice/NoticeScreen";
import NoticeDetailScreen from "../web/notice/NoticeDetailScreen";
import MapScreen from "../web/map/MapScreen";
import MypageScreen from "../web/my/MypageScreen";
import LoginScreen from "../web/intro/LoginScreen";
import RecommendScreen from "../web/recommend/RecommendScreen";
import CommunityScreen from "../web/community/CommunityScreen";

export default function Routing() {
    return (
        <Routes>
            <Route exact path="/" element={<MainScreen />} />
            <Route path="/login" element={<LoginScreen />} />

            {/* 추천 분양 현장 */}
            <Route path="/recommend" element={<RecommendScreen />} />

            {/* 실시간 매물지도 */}
            <Route path="/map" element={<MapScreen />} />

            {/* 마이메뉴 */}
            <Route path="/mypage" element={<MypageScreen />} />

            {/* 커뮤니티 */}
            <Route path="/community" element={<CommunityScreen />} />

            {/* 공지사항 */}
            <Route path="/notice" element={<NoticeScreen />} />
            <Route path="/notice/detail" element={<NoticeDetailScreen />} />
        </Routes>
    );
}
