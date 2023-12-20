import { createTheme } from "@mui/material/styles";

const Theme = createTheme({
    palette: {
        primary: {
            main: "#333333",
        },
        secondary: {
            main: "#CCCCCC",
        },
        error: {
            main: "#DA1E28",
        },
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
