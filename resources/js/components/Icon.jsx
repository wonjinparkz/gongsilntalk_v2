import React from "react";
import SvgIcons from "./SvgIcons.json";
import { SvgIcon } from "@mui/material";

export default function Icon({ icon, iconColor, className }) {
    const { width, height, viewBox, path } = SvgIcons[icon];

    return (
        <svg
            width={width}
            height={height}
            xmlns="http://www.w3.org/2000/svg"
            className={className}
            viewBox={viewBox}
            fill={iconColor}
            fillRule="evenodd"
            clipRule="evenodd"
            sx={{
                width: { width },
            }}
        >
            {path.map((item, index) => (
                <path key={index} d={path} />
            ))}
        </svg>
    );
}
