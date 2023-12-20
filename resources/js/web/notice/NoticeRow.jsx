import React from "react";

function NoticeRow({ click, notice }) {

    return <li onClick={click}>{notice.title}</li>;
}

export default NoticeRow;
