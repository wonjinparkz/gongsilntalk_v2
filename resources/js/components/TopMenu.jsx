import { Height } from "@mui/icons-material";
import { AppBar, Box, Divider, IconButton, Toolbar } from "@mui/material";
import React from "react";

export default function TopMenu() {
    const container =
        window !== undefined ? () => window().document.body : undefined;

    const toolbarStyle = { minHeight: "60px" };

    return (
        <Box sx={{ display: "flex" }}>
            <AppBar color="primary" position="fixed" elevation={0}>
                <Toolbar
                    style={toolbarStyle}
                    sx={{ borderBottom: 1, borderColor: "border.main"}}
                >

                </Toolbar>
            </AppBar>
        </Box>
    );
}
