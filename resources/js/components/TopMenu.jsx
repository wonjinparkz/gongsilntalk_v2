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
} from "@mui/material";
import React, { useState } from "react";

export default function TopMenu({ menuChange, loginClick }) {
    const container =
        window !== undefined ? () => window().document.body : undefined;

    const toolbarStyle = { minHeight: "60px" };

    const navItems = [
        { title: "추천 분양현장" },
        { title: "실시간 매물지도" },
        { title: "마이메뉴" },
        { title: "커뮤니티" },
    ];
    const [menuSelectValue, setMenuSelectValue] = useState(0);
    const handleMenuChange = (event, newValue) => {
        menuChange(event, newValue);
        setMenuSelectValue(newValue);
    };

    return (
        <AppBar
            color="primary"
            position="fixed"
            elevation={0}
            sx={{
                display: {
                    xs: "none",
                    md: "none",
                    lg: "block",
                },
            }}
        >
            <Toolbar
                style={toolbarStyle}
                sx={{
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
                        value={menuSelectValue}
                        onChange={handleMenuChange}
                        textColor="secondary"
                        sx={{
                            ".Mui-selected": {
                                color: "secondary.main",
                            },
                            fontFamily: "SpoqaHan",
                        }}
                    >
                        {navItems.map((item, index) => (
                            <Tab
                                key={index}
                                value={index}
                                label={item.title}
                                sx={{
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
                    <Button
                        color="black"
                        sx={{
                            fontFamily: "SpoqaHan",
                        }}
                    >
                        회원가입
                    </Button>
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
