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
    return (
        <Box>
            <TopMenu index={null}/>
            <BottomMenu />
        </Box>
    );
}
