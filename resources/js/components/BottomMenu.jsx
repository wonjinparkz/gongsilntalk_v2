import React from "react";
import {
    BottomNavigation,
    BottomNavigationAction,
    Box,
    Paper,
} from "@mui/material";
import HomeIcon from "@mui/icons-material/home";
import MapIcon from "@mui/icons-material/map";
import { Link, useNavigate } from "react-router-dom";

export default function BottomMenu() {
    const [value, setValue] = React.useState("");
    const navigate = useNavigate();
    const bottomItems = [
        {
            title: "홈화면",
            icon: <HomeIcon />,
            link: "/",
            onclick: () => navigate("/"),
        },
        {
            title: "지도보기",
            icon: <MapIcon />,
            link: "/map",
            onclick: () => navigate("/map"),
        },
        {
            title: "마이페이지",
            icon: <MapIcon />,
            link: "/my",
            onclick: () => navigate("/my"),
        },
    ];

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
            elevation={2}
        >
            <BottomNavigation
                showLabels
                value={value}
                onChange={(event, newValue) => {
                    navigate(newValue);
                    setValue(newValue);
                }}
            >
                {bottomItems.map((item, index) => (
                    <BottomNavigationAction
                        key={index}
                        label={item.title}
                        value={item.link}
                        onClick={item.onclick}
                        icon={item.icon}
                    />
                ))}
            </BottomNavigation>
        </Paper>
    );
}
