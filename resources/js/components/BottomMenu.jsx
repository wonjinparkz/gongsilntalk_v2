import React, { useState } from "react";
import {
    Alert,
    BottomNavigation,
    BottomNavigationAction,
    Divider,
    Paper,
} from "@mui/material";
import { Link, useNavigate } from "react-router-dom";
import { useAlert } from "../hook/useAlert";
import {
    homeIcon,
    recommendIcon,
    mapIcon,
    myIcon,
    communityIcon,
} from "./IconSet";

export default function BottomMenu({ index }) {
    const [AlertDialog, open, getProps] = useAlert();
    const navigate = useNavigate();
    const [menuSelectValue, setMenuSelectValue] = useState(index);
    const navItems = [
        { title: "홈", icon: homeIcon, link: "/" },
        { title: "분양현장", icon: recommendIcon, link: "/recommend" },
        { title: "지도", icon: mapIcon, link: "/map" },
        { title: "마이메뉴", icon: myIcon, link: "/mypage" },
        { title: "커뮤니티", icon: communityIcon, link: "/community" },
    ]; // 네비게이션 아이템

    const handleMenuChange = (event, newValue) => {
        if (newValue == 3) {
            navigate("/login");
            return;
        }
        navigate(navItems[newValue].link);
        setMenuSelectValue(newValue);
    }; // 네비게이션 메뉴 변경

    return (
        <Paper
            sx={{
                position: "fixed",
                bottom: 0,
                left: 0,
                right: 0,
                display: {
                    xs: "block",
                    md: "none",
                    lg: "none",
                },
            }}
            elevation={0}
        >
            <Divider sx={{ backgroundColor: "border.main" }} />
            <BottomNavigation
                showLabels
                value={menuSelectValue}
                onChange={handleMenuChange}
                sx={{
                    height: "50px",
                    "& .Mui-selected": {
                        "& .MuiBottomNavigationAction-label": {
                            fontSize: 12,
                            fontFamily: "SpoqaHanBold",
                            transition: "none",
                            lineHeight: "20px",
                        },
                        "& .MuiSvgIcon-root, & .MuiBottomNavigationAction-label":
                            {
                                color: (theme) => theme.palette.secondary.main,
                            },
                    },
                    "& .MuiSvgIcon-root": {
                        color: "border.main",
                    },
                    "& .MuiBottomNavigationAction-label": {
                        fontSize: 12,
                        fontFamily: "SpoqaHanRegular",
                        color: "border.main",
                        transition: "none",
                        lineHeight: "20px",
                    },
                }}
            >
                {navItems.map((item, index) => (
                    <BottomNavigationAction
                        key={index}
                        value={index}
                        label={item.title}
                        icon={item.icon}
                    />
                ))}
            </BottomNavigation>
        </Paper>
    );
}
