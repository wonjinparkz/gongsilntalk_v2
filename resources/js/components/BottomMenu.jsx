import React, { useState } from "react";
import {
    BottomNavigation,
    BottomNavigationAction,
    Divider,
    Icon,
    Paper,
    SvgIcon,
} from "@mui/material";
import { Link, useNavigate } from "react-router-dom";

export default function BottomMenu({ index }) {
    const navigate = useNavigate();

    const homeIcon = (
        <SvgIcon
            sx={{
                width: 16,
            }}
            viewBox="0 0 16 16"
        >
            <path d="M15.45 7.5L14 6.051V2.5C14 1.95 13.55 1.5 13 1.5H12C11.45 1.5 11 1.95 11 2.5V3.053L9 1.055C8.727 0.797 8.477 0.5 8 0.5C7.523 0.5 7.273 0.797 7 1.055L0.55 7.5C0.238 7.825 0 8.062 0 8.5C0 9.063 0.432 9.5 1 9.5H2V15.5C2 16.05 2.45 16.5 3 16.5H6V11.5C6 10.95 6.45 10.5 7 10.5H9C9.55 10.5 10 10.95 10 11.5V16.5H13C13.55 16.5 14 16.05 14 15.5V9.5H15C15.568 9.5 16 9.063 16 8.5C16 8.062 15.762 7.825 15.45 7.5Z" />
        </SvgIcon>
    );

    const recommendIcon = (
        <SvgIcon
            sx={{
                width: 16,
            }}
            viewBox="0 0 16 16"
        >
            <path d="M15.5556 0.5L15.4133 0.526667L10.6667 2.36667L5.33333 0.5L0.32 2.18889C0.133333 2.25111 0 2.41111 0 2.61556V16.0556C0 16.3044 0.195556 16.5 0.444444 16.5L0.586667 16.4733L5.33333 14.6333L10.6667 16.5L15.68 14.8111C15.8667 14.7489 16 14.5889 16 14.3844V0.944444C16 0.695556 15.8044 0.5 15.5556 0.5ZM10.6667 14.7222L5.33333 12.8467V2.27778L10.6667 4.15333V14.7222Z" />
        </SvgIcon>
    );

    const mapIcon = (
        <SvgIcon
            sx={{
                width: 16,
            }}
            viewBox="0 0 16 16"
        >
            <path d="M6.99437 3.48042C6.48298 3.12973 5.80853 3.12984 5.29726 3.48071L0.651236 6.66916C0.243607 6.9489 0 7.41154 0 7.90593V15.3984C0 15.9507 0.447715 16.3984 1 16.3984H4.28571V10.3396C4.28571 9.78733 4.73343 9.33961 5.28571 9.33961H6.71429C7.26657 9.33961 7.71429 9.78733 7.71429 10.3396V16.3984H11C11.5523 16.3984 12 15.9507 12 15.3984V7.70331C12 7.20875 11.7562 6.74596 11.3483 6.46625L6.99437 3.48042Z" />
            <path d="M7.77344 0.5C7.22115 0.5 6.77344 0.947716 6.77344 1.5V1.84222L8.50078 3.02444L9.99493 4.05554H11.0918V4.81109L12.8191 6.0022V7.61108H14.5465V9.38886H12.8191V11.1666H14.5465V12.9444H12.8191V15.4999C12.8191 16.0522 13.2668 16.4999 13.8191 16.4999H17.0011C17.5534 16.4999 18.0011 16.0522 18.0011 15.4999V1.5C18.0011 0.947715 17.5534 0.5 17.0011 0.5H7.77344ZM14.5465 5.83331H12.8191V4.05554H14.5465V5.83331Z" />
        </SvgIcon>
    );

    const myIcon = (
        <SvgIcon
            sx={{
                width: 16,
            }}
            viewBox="0 0 16 16"
        >
            <path d="M8 8.5C10.21 8.5 12 6.71 12 4.5C12 2.29 10.21 0.5 8 0.5C5.79 0.5 4 2.29 4 4.5C4 6.71 5.79 8.5 8 8.5ZM8 10.5C5.33 10.5 0 11.84 0 14.5V15.5C0 16.0523 0.447715 16.5 1 16.5H15C15.5523 16.5 16 16.0523 16 15.5V14.5C16 11.84 10.67 10.5 8 10.5Z" />
        </SvgIcon>
    );

    const communityIcon = (
        <SvgIcon
            sx={{
                width: 16,
            }}
            viewBox="0 0 16 16"
        >
            <path
                fillRule="evenodd"
                clipRule="evenodd"
                d="M4.14791 0.724464C6.20776 0.331624 8.92063 0.282042 10.7749 2.03266C10.8958 2.14708 10.9644 2.30345 10.9644 2.46364V15.8888C10.9644 16.2283 10.6782 16.4991 10.3194 16.4991C10.1461 16.4991 9.98482 16.4342 9.85986 16.3198C8.77148 15.29 7.13086 15.0269 5.38543 15.1985C3.6521 15.3701 1.95504 15.9537 0.931164 16.4342C0.612714 16.5868 0.225737 16.4647 0.0644963 16.1634L0 15.8926V2.46745C0 2.23861 0.137054 2.02503 0.354729 1.92205H0.35876L0.362791 1.91824L0.378915 1.91061L0.661086 1.78475C1.78171 1.31182 2.94667 0.953302 4.14791 0.724464ZM1.54821 2.87086V14.6722C2.64062 14.2526 3.70148 13.784 5.1607 13.6429C6.63606 13.4979 8.1574 13.6394 9.4957 14.3488V2.73443C8.12808 1.78475 6.25408 1.67414 4.3716 2.03266C3.30338 2.23861 2.5479 2.45514 1.54821 2.87086Z"
            />
            <path
                fillRule="evenodd"
                clipRule="evenodd"
                d="M16.0941 0.724464C14.1557 0.331624 11.6029 0.282043 9.85797 2.03266C9.74417 2.14708 9.67969 2.30345 9.67969 2.46364V15.8888C9.67969 16.2283 9.94901 16.4991 10.2866 16.4991C10.4459 16.4991 10.6014 16.4342 10.719 16.3198C11.7432 15.29 13.2871 15.0269 14.9295 15.1985C16.5606 15.3701 18.1576 15.9537 19.1211 16.4342C19.4207 16.5868 19.7849 16.4647 19.9366 16.1634L20.0011 15.8888V2.46364C20.0011 2.2348 19.8721 2.02122 19.6673 1.91824L19.3904 2.46745L19.6635 1.92205H19.6597L19.6559 1.91824L19.6407 1.91061L19.5838 1.88391C19.2652 1.73517 18.9428 1.59405 18.6128 1.46819C17.7972 1.14781 16.9551 0.899906 16.0941 0.724464Z"
            />
        </SvgIcon>
    );

    const navItems = [
        { title: "홈", icon: homeIcon, link: "/" },
        { title: "분양현장", icon: recommendIcon, link: "/recommend" },
        { title: "지도", icon: mapIcon, link: "/map" },
        { title: "마이메뉴", icon: myIcon, link: "/mypage" },
        { title: "커뮤니티", icon: communityIcon, link: "/community" },
    ];

    // 메뉴 변경
    const [menuSelectValue, setMenuSelectValue] = useState(index);
    const handleMenuChange = (event, newValue) => {
        navigate(navItems[newValue].link);
        setMenuSelectValue(newValue);
    };

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
                            fontWeight: "bold",
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
                        fontWeight: "normal",
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
