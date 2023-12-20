import { Button, ListItemButton, ListItemText, Toolbar } from "@mui/material";
import React, { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import TopMenu from "../components/TopMenu";

export default function MainScreen() {
    let [name, setName] = useState();
    const navigate = useNavigate();

    return (
        <div>
            <TopMenu />
        </div>
    );
}
