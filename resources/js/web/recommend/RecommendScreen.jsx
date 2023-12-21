import { Box } from "@mui/material";
import React from "react";
import TopMenu from "../../components/TopMenu";
import BottomMenu from "../../components/BottomMenu";

/**
 * 추천 분양 현장
 */
export default function RecommendScreen() {
    return (
        <Box>
            <TopMenu index={0} />
            <BottomMenu />
        </Box>
    );
}
