import React from "react";
import {
    Box,
    Card,
    CardContent,
    CardMedia,
    Checkbox,
    Chip,
    Divider,
    Hidden,
    Typography,
} from "@mui/material";
import FavoriteBorder from "@mui/icons-material/FavoriteBorder";
import Favorite from "@mui/icons-material/Favorite";

export default function RecommendRow({ click }) {
    return (
        <Box>
            <Card
                onClick={click}
                sx={{
                    width: "100%",
                    height: {
                        xs: "128px",
                        md: "128px",
                        lg: "295px",
                    },

                    borderRadius: 0,
                    backgroundColor: "clear.main",
                    display: "flex",
                    flexDirection: {
                        xs: "row",
                        md: "row",
                        lg: "column",
                    },
                }}
                elevation={0}
            >
                <Box
                    sx={{
                        display: "flex",
                        position: "relative",
                    }}
                >
                    <CardMedia
                        image="assets/media/s_1.png"
                        component="img"
                        sx={{
                            width: {
                                xs: "100px",
                                md: "100px",
                                lg: "100%",
                            },
                            height: {
                                xs: "100px",
                                md: "100px",
                                lg: "196px",
                            },
                        }}
                    />

                    <Checkbox
                        sx={{
                            position: "absolute",
                            right: 0,
                        }}
                        icon={<FavoriteBorder color="primary" />}
                        checkedIcon={<Favorite color="secondary" />}
                    />
                </Box>

                <Box
                    sx={{
                        backgroundColor: "clear.main",
                        ml: {
                            xs: "14px",
                            md: "14px",
                            lg: "0px",
                        },
                    }}
                >
                    <Chip
                        label="분양중"
                        color="secondary"
                        sx={{
                            borderRadius: "6px",
                            mt: {
                                xs: "0px",
                                md: "0px",
                                lg: "9px",
                            },
                        }}
                    />

                    <Typography
                        sx={{ fontSize: 20, fontWeight: "bold", mt: "10px" }}
                    >
                        지식산업센터 놀라움 마곡
                    </Typography>
                    <Typography sx={{ fontSize: 16 }}>
                        서울시 강서구 강동동
                    </Typography>
                </Box>
            </Card>
            <Divider
                sx={{
                    display: {
                        xs: "block",
                        md: "block",
                        lg: "none",
                    },
                }}
            />
        </Box>
    );
}
