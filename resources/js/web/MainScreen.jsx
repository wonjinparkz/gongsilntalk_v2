import { Button, ListItemButton, ListItemText, Toolbar } from "@mui/material";
import React, { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";

export default function MainScreen() {
    let [name, setName] = useState();
    const navigate = useNavigate();
    const noticeCLick = () => {
        // setName("로켓");
        // name = "로켓";
        // navigate("/notice", { replace: false });
    };

    return (
        <div>
            <Toolbar />
            <h1>홈화면</h1>
            <Button style={{ margin: 10 }} variant="contained">
                버튼
            </Button>
        </div>
    );
}
