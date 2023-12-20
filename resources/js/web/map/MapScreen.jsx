import { Toolbar } from "@mui/material";
import React, { useEffect, useRef } from "react";
import Map from "./Map";

function MapScreen() {
    useEffect(() => {}, []);
    const naverClientId = import.meta.env.VITE_NAVER_MAP_CLIENT_ID;
    return (
        <div>
            <Toolbar />
            <Map />
        </div>
    );
}

export default MapScreen;
