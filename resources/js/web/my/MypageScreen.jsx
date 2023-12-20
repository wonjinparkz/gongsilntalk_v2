import { Box, Container, Grid, Paper, Toolbar } from "@mui/material";
import { makeStyles } from "@mui/styles";
import React from "react";
import theme from "../../styles/Theme";

const useStyles = makeStyles((theme) => ({
    root: {
        flexGrow: 1,
    },
    paper: {
        padding: theme.spacing(2),
        textAlign: "center",
        color: theme.palette.text.primary,
        backgroundColor: theme.palette.error
    },
}));

function MypageScreen() {


    const classes = useStyles(theme);

    return (
        <Container maxWidth="sm">
            <Grid container spacing={3}>
                <Grid item xs={12}>
                    <Paper className={classes.paper}>xs=12</Paper>
                </Grid>

                <Grid item xs={6}>
                    <Paper className={classes.paper}>xs=3</Paper>
                </Grid>

                <Grid item xs={6} >
                    <Paper className={classes.paper}>xs=12</Paper>
                </Grid>
            </Grid>
        </Container>
    );
}

export default MypageScreen;
