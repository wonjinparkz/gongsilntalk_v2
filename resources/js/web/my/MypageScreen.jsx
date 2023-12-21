import { Box, Container, Grid, Paper, Toolbar } from "@mui/material";
import React from "react";
import TopMenu from "../../components/TopMenu";
import BottomMenu from "../../components/BottomMenu";

export default function MypageScreen() {
    return (
        <Box>
            <TopMenu index={2} />
            <BottomMenu />
        </Box>
    );
}
