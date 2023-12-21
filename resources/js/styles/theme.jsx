import { createTheme } from "@mui/material/styles";
import fonts from "./fonts/fonts";

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
            main: "#D2D1D0",
        },
        black: {
            main: "#000000",
        },
        signupButton: {
            main: "#D2D1D0",
            contrastText: "#000000"
        }
    },
    typography: {
        fontFamily: ["SpoqaHan"].join(","),
        fontSize: 16
    },
});

export default Theme;
