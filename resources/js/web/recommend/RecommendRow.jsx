import React from "react";
import {
    Box,
    Card,
    CardContent,
    CardMedia,
    Checkbox,
    Chip,
    Hidden,
    Typography,
} from "@mui/material";
import FavoriteBorder from "@mui/icons-material/FavoriteBorder";
import Favorite from "@mui/icons-material/Favorite";

export default function RecommendRow({ click }) {
    return (
        <Card
            onClick={click}
            sx={{
                width: "100%",
                height: "295px",
                borderRadius: 0,
                backgroundColor: "background.main",
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
                    height="196px"
                />

                <Checkbox
                    sx={{
                        position: "absolute",
                        right: 0,
                        margin: 1,
                    }}
                    icon={<FavoriteBorder color="primary" />}
                    checkedIcon={<Favorite color="secondary" />}
                />
            </Box>

            <Box sx={{ backgroundColor: "background.main" }}>
                <Chip
                    label="분양중"
                    color="secondary"
                    sx={{ borderRadius: "6px", mt: "9px" }}
                />

                <Typography sx={{ fontSize: 20, fontWeight: "bold" }}>
                    지식산업센터 놀라움 마곡
                </Typography>
                <Typography sx={{ fontSize: 16 }}>
                    서울시 강서구 강동동
                </Typography>
            </Box>
        </Card>
    );
}
