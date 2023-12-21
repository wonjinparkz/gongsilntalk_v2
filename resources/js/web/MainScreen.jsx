import {
    Button,
    ListItemButton,
    ListItemText,
    Paper,
    Toolbar,
} from "@mui/material";
import React, { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import TopMenu from "../components/TopMenu";
import BottomMenu from "../components/BottomMenu";

export default function MainScreen() {
    let [name, setName] = useState();
    const navigate = useNavigate();

    return (
        <div>
            <TopMenu />
            <Paper
                sx={{ position: "fixed", bottom: 0, left: 0, right: 0 }}
                elevation={2}
            >
                <BottomMenu />
            </Paper>
        </div>
    );
}
