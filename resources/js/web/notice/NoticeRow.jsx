import React from "react";

function NoticeRow({ onClick, notice }) {

    return <li onClick={onClick}>{notice.title}</li>;
}

export default NoticeRow;
