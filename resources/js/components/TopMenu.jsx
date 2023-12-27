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
            <Toolbar
                sx={{
                    height: "60px",
                    borderBottom: 1,
                    borderColor: "border.main",
                    justifyContent: "space-between",
                }}
            >
                <Box
                    component="img"
                    sx={{
                        ml: 3,
                        width: 100,
                    }}
                    src="assets/media/header_logo.png"
                />

                <Box
                    sx={{
                        justifyContent: "center",
                    }}
                >
                    <Tabs
                        value={
                            menuSelectValue == null ? false : menuSelectValue
                        }
                        onChange={handleMenuChange}
                        textColor="secondary"
                    >
                        {navItems.map((item, index) => (
                            <Tab
                                key={index}
                                value={index}
                                label={item.title}
                                sx={{
                                    ".Mui-selected": {
                                        color: "secondary.main",
                                    },
                                    fontFamily: "SpoqaHanBold",
                                    fontSize: 16,
                                    paddingLeft: "50px",
                                    paddingRight: "50px",
                                }}
                            />
                        ))}
                    </Tabs>
                </Box>
                <Box>
                    <Button color="black" onClick={loginClick}>
                        로그인
                    </Button>
                    <Button color="black">회원가입</Button>
                    <Button
                        color="signupButton"
                        variant="contained"
                        disableElevation
                        sx={{
                            ml: 3,
                            borderRadius: 20,
                            paddingTop: "5px",
                            paddingBottom: "5px",
                            paddingLeft: 2,
                            paddingRight: 2,
                        }}
                    >
                        중개사 가입
                    </Button>
                </Box>
            </Toolbar>
        </AppBar>
    );
}
