import { createTheme } from "@mui/material/styles";

const Theme = createTheme({
    palette: {
        primary: {
            main: "#ffffff",
        },
        secondary: {
            main: "#F16341",
        },
        error: {
            main: "#DA1E28",
        },
        border: {
            main: "#D2D1D0"
        }
    },
    typography: {
        fontFamily: [
            "Noto Sans KR",
            "sans-serif",
            "-apple-system",
            "BlinkMacSystemFont",
            "Segoe UI",
            "Roboto",
            "Oxygen",
            "Ubuntu",
            "Cantarell",
            "Fira Sans",
            "Droid Sans",
            "Helvetica Neue",
        ].join(","),
    },
});

export default Theme;
