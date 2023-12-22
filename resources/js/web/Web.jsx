import React from "react";
import ReactDOM from "react-dom/client";
import Routing from "../router/Routing";
import { BrowserRouter as Router } from "react-router-dom";
import { ThemeProvider } from '@mui/material/styles';
import Theme from "../styles/Theme";
import { CssBaseline } from "@mui/material";

function Web() {
    return (
        <ThemeProvider theme={Theme}>
            <CssBaseline/>
            <Router>
                <Routing />
            </Router>
        </ThemeProvider>
    );
}

export default Web;

if (document.getElementById("app")) {
    const rootNode = document.getElementById("app");
    ReactDOM.createRoot(rootNode).render(<Web />);
}
