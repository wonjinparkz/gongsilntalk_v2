import React from "react";
import {
    Box,
    Card,
    CardMedia,
    Checkbox,
    Chip,
    Divider,
    Typography,
} from "@mui/material";
import FavoriteBorder from "@mui/icons-material/FavoriteBorder";
import Favorite from "@mui/icons-material/Favorite";

export default function RecommendMRow({ click }) {
    return (
        <Box
            onClick={click}
            sx={{
                display: "flex",
                flexDirection: "column",
            }}
        >
            <Card
                elevation={0}
                sx={{
                    mt: "9px",
                    height: "128px",
                    display: "flex",
                    flexDirection: "row",
                    alignContent: "center",
                }}
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
                            width: "100px",
                            height: "100px",
                        }}
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
                <Box sx={{ ml: "14px" }}>
                    <Chip
                        label="분양중"
                        color="secondary"
                        sx={{ borderRadius: "6px" }}
                    />

                    <Typography
                        sx={{ mt: "10px", fontSize: 16, fontWeight: "bold" }}
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
                    backgroundColor: "border.main",
                }}
            />
        </Box>
    );
}
