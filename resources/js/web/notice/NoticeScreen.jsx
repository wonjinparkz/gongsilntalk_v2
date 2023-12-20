import React, { useEffect, useState } from "react";
import { Link, NavLink, useNavigate } from "react-router-dom";
import NoticeRow from "./NoticeRow";
import { Toolbar } from "@mui/material";

function NoticeScreen() {
    const [notices, setNotices] = useState([]);

    const navigate = useNavigate();
    useEffect(() => {
        notifceList(setNotices);
    }, []);

    const headerClick = () => {

    };

    const noticeCLick = () => {
        // navigate("/notice/detail", { replace: false });
    };

    const listItem = notices.map((notice) => {
        return (
            <NavLink to={"/notice/detail"}>
                <NoticeRow notice={notice} />
            </NavLink>
        );
    });

    return (
        <div>
            <Toolbar />
            <h1 onClick={headerClick}>공지사항 목록</h1>
            <input type="text" />
            <ul>{listItem}</ul>
        </div>
    );
}

// 공지사항 목록 API
function notifceList(setNotices) {
    axios
        .get("http://localhost/api/notice/list", {
            params: {
                page: 1,
                per_page: 10,
                type: 0,
            },
        })
        .then((response) => {
            setNotices((old) => [...old, ...response.data.result.data]);
        });
}

export default NoticeScreen;
