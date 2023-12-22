import React, { useState } from "react";
import TopMenu from "../../components/TopMenu";
import BottomMenu from "../../components/BottomMenu";
import {
    Box,
    Typography,
    Grid,
    Select,
    MenuItem,
    Container,
    Button,
    ToggleButtonGroup,
    ToggleButton,
    alpha,
    CssBaseline,
} from "@mui/material";
import Theme from "../../styles/Theme";
/**
 * 추천 분양 현장
 */
export default function RecommendScreen() {
    const [status, setstatus] = useState(0);
    const statusChange = (event) => {
        setstatus(event.target.value);
    };

    const [area, setArea] = useState(0);
    const areaList = [
        [
            { title: "전체", index: 0 },
            { title: "서울", index: 1 },
            { title: "성수동", index: 2 },
            { title: "문정동", index: 3 },
            { title: "영등포", index: 4 },
            { title: "가산/구로", index: 5 },
        ],
        [
            { title: "인천/부천", index: 6 },
            { title: "시흥/안산", index: 7 },
            { title: "과천/광명", index: 8 },
            { title: "안양/군포", index: 9 },
            { title: "수원/의왕", index: 10 },
            { title: "하남/성남", index: 11 },
        ],
        [
            { title: "김포/고양", index: 12 },
            { title: "구리/남양주", index: 13 },
            { title: "동탄/용인", index: 14 },
            { title: "오산/평택", index: 15 },
            { title: "부산", index: 16 },
            { title: "기타", index: 17 },
        ],
    ];

    // 지역 설정
    const areaChange = (event, newValue) => {
        setArea(newValue);
    };

    const areaSelectChange = (event) => {
        setArea(event.target.value);
    };

    // 지역 설정 버튼 스타일
    const toggleButtonStyle = {
        borderRadius: 0,
        fontSize: 18,
        "&:hover": {
            backgroundColor: "secondary.alpha",
        },
        "&.Mui-selected, &.Mui-selected:hover": {
            color: "secondary.main",
            backgroundColor: "secondary.alpha",
            border: "1px solid !important",
            borderColor: "secondary.main",
        },
    };

    return (
        <Box>
            <TopMenu index={0} />
            <Box
                sx={{
                    display: "flex",
                    flexDirection: "column",
                    backgroundColor: "primary.main",
                }}
            >
                <Container
                    sx={{
                        display: "flex",
                        flexDirection: "column",
                        pb: {
                            xs: 4,
                            md: 8,
                            lg: 8,
                        },
                    }}
                >
                    <Typography
                        sx={{
                            display: "flex",
                            mt: 4,
                            fontSize: 24,
                            justifyContent: "center",
                            alignContent: "center",
                            fontFamily: "SpoqaHanBold",
                        }}
                    >
                        실시간 분양현장
                    </Typography>
                    <Box sx={{ display: "flex" }}>
                        <Select
                            label="상태구분"
                            displayEmpty
                            value={status}
                            onChange={statusChange}
                            sx={{
                                width: {
                                    xs: "100vw",
                                    md: "266px",
                                    lg: "266px",
                                },
                                height: 38,
                                mt: 4,
                                fontSize: 16,
                                border: 0.5,
                                borderColor: "border.main",
                                ".MuiOutlinedInput-notchedOutline": {
                                    border: "none ! important",
                                },
                            }}
                        >
                            <MenuItem value={0} sx={{ fontSize: 16 }}>
                                전체
                            </MenuItem>
                            <MenuItem value={1} sx={{ fontSize: 16 }}>
                                분양예정
                            </MenuItem>
                            <MenuItem value={2} sx={{ fontSize: 16 }}>
                                분양중
                            </MenuItem>
                        </Select>

                        <Select
                            label="지역구분"
                            displayEmpty
                            value={area}
                            onChange={areaSelectChange}
                            sx={{
                                width: {
                                    xs: "100vw",
                                },
                                visibility: {
                                    xs: "visible",
                                    md: "hidden",
                                    lg: "hidden",
                                },
                                ml: 3,
                                height: 38,
                                mt: 4,
                                fontSize: 16,
                                border: 0.5,
                                borderColor: "border.main",
                                ".MuiOutlinedInput-notchedOutline": {
                                    border: "none ! important",
                                },
                            }}
                        >
                            {areaList.map((item, index) => {
                                return item.map((area) => (
                                    <MenuItem
                                        key={area.index}
                                        value={area.index}
                                        sx={{ fontSize: 16 }}
                                    >
                                        {area.title}
                                    </MenuItem>
                                ));
                            })}
                        </Select>
                    </Box>

                    <Box
                        sx={{
                            display: {
                                xs: "none",
                                md: "none",
                                lg: "flex",
                            },
                            flexDirection: "column",
                        }}
                    >
                        <ToggleButtonGroup
                            fullWidth
                            orientation="horizontal"
                            onChange={areaChange}
                            value={area}
                            exclusive
                            sx={{ mt: 4, height: 50, borderRadius: 0 }}
                        >
                            {areaList[0].map((item, index) => (
                                <ToggleButton
                                    key={item.index}
                                    value={item.index}
                                    sx={toggleButtonStyle}
                                >
                                    <Typography>{item.title}</Typography>
                                </ToggleButton>
                            ))}
                        </ToggleButtonGroup>

                        <ToggleButtonGroup
                            fullWidth
                            orientation="horizontal"
                            onChange={areaChange}
                            value={area}
                            exclusive
                            sx={{
                                height: 50,
                                borderRadius: 0,
                                mt: "-1px",
                            }}
                        >
                            {areaList[1].map((item, index) => (
                                <ToggleButton
                                    key={item.index}
                                    value={item.index}
                                    sx={toggleButtonStyle}
                                >
                                    <Typography>{item.title}</Typography>
                                </ToggleButton>
                            ))}
                        </ToggleButtonGroup>

                        <ToggleButtonGroup
                            fullWidth
                            orientation="horizontal"
                            onChange={areaChange}
                            value={area}
                            exclusive
                            sx={{
                                height: 50,
                                borderRadius: 0,
                                mt: "-1px",
                            }}
                        >
                            {areaList[2].map((item, index) => (
                                <ToggleButton
                                    key={item.index}
                                    value={item.index}
                                    sx={toggleButtonStyle}
                                >
                                    <Typography>{item.title}</Typography>
                                </ToggleButton>
                            ))}
                        </ToggleButtonGroup>
                    </Box>
                </Container>
            </Box>
            <BottomMenu index={1} />
        </Box>
    );
}
