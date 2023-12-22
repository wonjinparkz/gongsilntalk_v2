import { Box } from "@mui/material";
import React from "react";
import TopMenu from "../components/TopMenu";
import BottomMenu from "../components/BottomMenu";

export default function MainScreen() {
    return (
        <Box>
            <TopMenu index={null} />
            <BottomMenu index={0} />
        </Box>
    );
}
