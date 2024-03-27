import { Height } from "@mui/icons-material";
import {
    AppBar,
    Box,
    Menu,
    MenuItem,
    Tab,
    Tabs,
    Toolbar,
    Typography,
    Button,
    Divider,
    Drawer,
} from "@mui/material";
import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

export default function TopMenu({ index }) {
    const navigate = useNavigate();
    const [menuSelectValue, setMenuSelectValue] = useState(index);
    const navItems = [
        { title: "추천 분양현장", link: "/recommend" },
        { title: "실시간 매물지도", link: "/map" },
        { title: "마이메뉴", link: "/mypage" },
        { title: "커뮤니티", link: "/community" },
    ];

    const loginClick = () => {
        navigate("/login");
    };

    // 메뉴 변경
    const handleMenuChange = (event, newValue) => {
        if (newValue == 2) {
            return;
        }
        navigate(navItems[newValue].link);
        setMenuSelectValue(newValue);
    };

    return (
        <AppBar
            color="primary"
            elevation={0}
            position="sticky"
            sx={{
                display: {
                    xs: "none",
                    md: "none",
                    lg: "block",
                },
            }}
        >


        </AppBar>
    );
}
