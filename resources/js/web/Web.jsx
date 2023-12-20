import React from "react";
import ReactDOM from "react-dom/client";
import Routing from "../router/Routing";
import {
    NavLink,
    BrowserRouter as Router,
    Routes,
    Route,
} from "react-router-dom";
import DrawerAppBar from "../components/DrawerAppBar";
import { ThemeProvider } from "@mui/material/styles";
import theme from "../styles/Theme";
import { CssBaseline, Paper, Container } from "@mui/material";
import BottomMenu from "../components/BottomMenu";

function Web() {
    return (
        <ThemeProvider theme={theme}>
            <Container fixed>
                <Router>
                    <DrawerAppBar />
                    <Routing />
                    <Paper sx={{ position: "fixed", bottom: 0, left: 0, right: 0 }} elevation={2} >
                        <BottomMenu />
                    </Paper>
                </Router>
            </Container>
        </ThemeProvider>
    );
}

export default Web;

if (document.getElementById("app")) {
    const rootNode = document.getElementById("app");
    ReactDOM.createRoot(rootNode).render(<Web />);
}
