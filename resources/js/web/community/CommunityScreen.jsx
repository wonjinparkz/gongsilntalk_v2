import { Box } from "@mui/material";
import React from "react";
import TopMenu from "../../components/TopMenu";
import BottomMenu from "../../components/BottomMenu";

export default function CommunityScreen() {
    return (
        <Box>
            <TopMenu index={3} />
            <BottomMenu index={4} />
        </Box>
    );
}
