import React, { useEffect, useState } from "react";
import { Link, NavLink, useNavigate } from "react-router-dom";
import NoticeRow from "./NoticeRow";
import { CssBaseline, Drawer, Modal, Toolbar } from "@mui/material";
import NoticeDetailScreen from "./NoticeDetailScreen";

function NoticeScreen() {
    const style = {
        position: "absolute",
        width: "100%",
        height: "100%",
        bgcolor: "primary.main",
        border: "1px solid #000",
    };

    const [notices, setNotices] = useState([]);

    const navigate = useNavigate();
    useEffect(() => {
        notifceList(setNotices);
    }, []);

    const [open, setOpen] = React.useState(false);
    const noticeCLick = () => {
        console.log("공지사항 클릭");
        setOpen(true);
    };
    const handleClose = () => {
        setOpen(false);
    };

    const listItem = notices.map((notice, index) => {
        return <NoticeRow key={index} notice={notice} onClick={noticeCLick} />;
    });

    return (
        <div>
            <Toolbar />
            <h1>공지사항 목록</h1>
            <input type="text" />
            <ul>{listItem}</ul>
            <CssBaseline />

            <Drawer anchor="right" open={open} hideBackdrop={true}>
                <NoticeDetailScreen close={handleClose} />
            </Drawer>

            {/* <Modal style={style} open={open}>
                <div>

                </div>
            </Modal> */}
        </div>
    );
}

// 공지사항 목록 API
function notifceList(setNotices) {
    axios
        .get("http://localhost/api/notice/list", {
            params: {
                page: 1,
                per_page: 100,
                type: 0,
            },
        })
        .then((response) => {
            setNotices((old) => [...old, ...response.data.result.data]);
        });
}

export default NoticeScreen;
