import { Toolbar } from "@mui/material";
import React from "react";
import { useNavigate } from "react-router-dom";

function NoticeDetailScreen() {
    const navigate = useNavigate();
    const historyBack = () => {
        navigate(-1);
    };

    return (
        <div>
            <Toolbar />
            <h1 onClick={historyBack}>공지사항 상세</h1>
        </div>
    );
}

export default NoticeDetailScreen;
