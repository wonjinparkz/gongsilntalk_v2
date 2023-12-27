import { AppBar, Toolbar, Box } from "@mui/material";
import React from "react";
import { useNavigate } from "react-router-dom";

export default function ToolMenu() {
    const navigate = useNavigate();
    const closeClick = () => {
        navigate(-1);
    };

    return (
        <AppBar color="primary" elevation={0} position="sticky">
            <Toolbar
                sx={{
                    height: "60px",
                }}
            >
                <Box
                    component="img"
                    onClick={closeClick}
                    sx={{
                        width: 13,
                    }}
                    src="assets/media/btn_md_close.png"
                />
            </Toolbar>
        </AppBar>
    );
}
