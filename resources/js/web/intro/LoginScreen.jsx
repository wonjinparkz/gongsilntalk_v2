import { Box } from "@mui/material";
import React from "react";
import { Link } from "react-router-dom";
import TopMenu from "../../components/TopMenu";
import BottomMenu from "../../components/BottomMenu";

function LoginScreen() {
    return (
        <Box>
            <TopMenu index={null} />
            <BottomMenu />
        </Box>
    );
}

export default LoginScreen;
