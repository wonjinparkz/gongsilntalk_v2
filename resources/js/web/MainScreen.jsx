import {
    Box,
    Button,
    Container,
    ListItemButton,
    ListItemText,
    Paper,
    Stack,
    Toolbar,
} from "@mui/material";
import React, { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import TopMenu from "../components/TopMenu";
import BottomMenu from "../components/BottomMenu";
import NoticeScreen from "./notice/NoticeScreen";
import MapScreen from "./map/MapScreen";
import NoticeDetailScreen from "./notice/NoticeDetailScreen";
import MypageScreen from "./my/MypageScreen";
import LoginScreen from "./intro/LoginScreen";

export default function MainScreen() {
    let [name, setName] = useState();
    const navigate = useNavigate();

    const [screen, setScreen] = useState(<NoticeScreen />);

    const screenList = [
        <NoticeScreen />,
        <MapScreen />,
        <MypageScreen />,
        <NoticeDetailScreen />,
    ];

    // 메뉴 변경
    const menuChange = (event, newValue) => {
        setScreen(screenList[newValue]);
    };

    // 로그인 클릭
    const loginClick = () => {
        console.log("로그인 클릭");
        setScreen(<LoginScreen/>)
    };

    return (
        <Stack>
            <TopMenu menuChange={menuChange} loginClick={loginClick}/ >

            <div position="fixed" id="container">{screen}</div>

            <Paper
                sx={{ position: "fixed", bottom: 0, left: 0, right: 0 }}
                elevation={2}
            >
                <BottomMenu />
            </Paper>
        </Stack>
    );
}
