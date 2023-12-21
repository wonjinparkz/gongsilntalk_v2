import { Box, Toolbar } from "@mui/material";
import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";

function NoticeDetailScreen({ close }) {
    const [notice, setNotice] = useState(null);

    useEffect(() => {
        noticeDetail(setNotice);
    }, []);

    return (
        <Box
            height="100vh"
            sx={{
                width: {
                    xs: "100%",
                    md: "100%",
                    lg: "50vw",
                },
                backgroundColor: "primary.main",
            }}
        >
            <h1 onClick={close}>뒤로가기</h1>
            <h1>공지사항 상세</h1>
            {notice}
            <Box height={10000}></Box>
        </Box>
    );
}

// 공지사항 목록 API
function noticeDetail(setNotice) {
    axios
        .get("http://localhost/api/notice/detail", {
            params: {
                id: 3,
            },
        })
        .then((response) => {
            setNotice(response.data.result.content);
        });
}

export default NoticeDetailScreen;
