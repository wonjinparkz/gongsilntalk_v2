import { createTheme } from "@mui/material/styles";

import SpoqaHanRegular from "./fonts/SpoqaHanSansNeo-Regular.woff";
import SpoqaHanRegularWoff2 from "./fonts/SpoqaHanSansNeo-Regular.woff2";
import SpoqaHanBold from "./fonts/SpoqaHanSansNeo-Bold.woff";
import SpoqaHanBoldWoff2 from "./fonts/SpoqaHanSansNeo-Bold.woff2";
import SpoqaHanLight from "./fonts/SpoqaHanSansNeo-Light.woff";
import SpoqaHanLightWoff2 from "./fonts/SpoqaHanSansNeo-Light.woff2";
import SpoqaHanMedium from "./fonts/SpoqaHanSansNeo-Medium.woff";
import SpoqaHanMediumWoff2 from "./fonts/SpoqaHanSansNeo-Medium.woff2";

const Theme = createTheme({
    palette: {
        primary: {
            main: "#ffffff",
        },
        secondary: {
            main: "#F16341",
            alpha: "#F1634110",
        },
        error: {
            main: "#DA1E28",
        },
        background: {
            main: "#F5F5F5",
        },
        border: {
            main: "#D2D1D0",
            light: "#EEEDED"
        },
        black: {
            main: "#000000",
        },
        clear: {
            main: "#ffffff00",
        },
        gray: {
            main: "#9D9999",
        },
        signupButton: {
            main: "#D2D1D0",
            contrastText: "#000000",
        },
    },
    typography: {
        fontFamily: ["SpoqaHanRegular"].join(","),
        fontSize: 16,
    },
    components: {
        MuiCssBaseline: {
            styleOverrides: `
            @font-face {
              font-family: 'SpoqaHanRegular';
              font-style: normal;
              font-display: swap;
              font-weight: 400;
              src: url(${SpoqaHanRegularWoff2}) format('woff2');
            }
            @font-face {
                font-family: 'SpoqaHanBold';
                font-style: normal;
                font-display: swap;
                font-weight: 400;
                src: url(${SpoqaHanBoldWoff2}) format('woff2');
            }
          `,
        },
    },
});

export default Theme;
