import {
    Box,
    Card,
    Button,
    TextField,
    Typography,
    IconButton,
} from "@mui/material";
import React, { useRef } from "react";
import TopMenu from "../../components/TopMenu";
import Icon from "../../components/Icon";
import { IconSet } from "../../components/IconSet";
import { ColorSet } from "../../components/ColorSet";
import { isMobile } from "react-device-detect";
import ToolMenu from "../../components/ToolMenu";

export default function LoginScreen() {
    //------------------------------------------------------------------------------
    // * Local variables
    //------------------------------------------------------------------------------
    const emailRef = useRef();
    const passwordRef = useRef();

    //------------------------------------------------------------------------------
    // * Local function
    //------------------------------------------------------------------------------
    // 로그인 API
    const login = () => {
        axios
            .post("http://localhost/api/signin", {
                params: {
                    email: emailRef.current.value,
                    password: passwordRef.current.value,
                },
            })
            .then((response) => {});
    };

    //------------------------------------------------------------------------------
    // * UI Render
    //------------------------------------------------------------------------------
    return (
        <Box
            sx={{
                display: "flex",
                flexDirection: "column",
                height: "100vh",
                backgroundColor: {
                    xs: "primary.main",
                    md: "background.main",
                    lg: "background.main",
                },
            }}
        >
            {isMobile ? <ToolMenu /> : <TopMenu index={null} />}

            <Box
                sx={{
                    display: "flex",
                    width: "100%",
                    height: "100%",
                    flexDirection: "column",
                    justifyContent: "center",
                }}
            >
                <Card
                    elevation={0}
                    sx={{
                        width: {
                            xs: "100vw",
                            md: "100vw",
                            lg: "518px",
                        },
                        pl: {
                            xs: 4,
                            md: 4,
                            lg: 10,
                        },
                        pr: {
                            xs: 4,
                            md: 4,
                            lg: 10,
                        },
                        display: "flex",
                        flexDirection: "column",
                        alignSelf: "center",
                        borderRadius: 3,
                        border: { xs: 0, md: 0, lg: 1 },
                        borderColor: { xs: "", md: "", lg: "border.light" },
                    }}
                >
                    <Typography
                        sx={{
                            alignSelf: "center",
                            fontSize: 22,
                            fontWeight: "bold",
                            mt: { xs: 0, md: 0, lg: 5 },
                        }}
                    >
                        공실앤톡 로그인
                    </Typography>

                    {/* 아이디 */}
                    <Box
                        sx={{
                            display: "flex",
                            border: "1px solid",
                            borderColor: "border.main",
                            borderRadius: 2,
                            mt: 5,
                        }}
                    >
                        <TextField
                            fullWidth
                            placeholder="이메일을 입력해주세요."
                            inputRef={emailRef}
                            type={"email"}
                            sx={{
                                "& .MuiInputLabel-root": { display: "none" },
                                "& .MuiOutlinedInput-notchedOutline": {
                                    border: "none",
                                },

                                fontSize: 16,
                            }}
                        />
                    </Box>

                    {/* 비밀번호  */}
                    <Box
                        sx={{
                            display: "flex",
                            border: "1px solid",
                            borderColor: "border.main",
                            borderRadius: 2,
                            mt: 1,
                        }}
                    >
                        <TextField
                            placeholder="비밀번호를 입력해주세요."
                            fullWidth
                            inputRef={passwordRef}
                            type={"password"}
                            sx={{
                                "& .MuiInputLabel-root": { display: "none" },
                                "& .MuiOutlinedInput-notchedOutline": {
                                    border: "none",
                                },
                                "::-webkit-input-placeholder": {
                                    color: ColorSet.color_03C75A,
                                },
                                "::placeholder": {
                                    color: ColorSet.color_03C75A,
                                },
                                fontSize: 16,
                            }}
                        />
                    </Box>

                    <Box
                        sx={{
                            display: "flex",
                            justifyContent: "flex-end",
                            mt: 1,
                        }}
                    >
                        <Button variant="text" color="gray">
                            비밀번호찾기
                        </Button>
                    </Box>

                    <Button
                        variant="contained"
                        onClick={login}
                        sx={{
                            mt: 1,
                            borderRadius: "5px",
                            fontFamily: "SpoqaHanBold",
                            height: "50px",
                            fontSize: "16px",
                            color: ColorSet.color_ffffff,
                            backgroundColor: ColorSet.color_F16341,
                            ":hover": {
                                backgroundColor: ColorSet.color_F16341,
                            },
                        }}
                    >
                        로그인
                    </Button>

                    {/* 소셜로그인 버튼  */}
                    <Box
                        sx={{
                            display: "flex",
                            justifyContent: "center",
                            mt: 4,
                        }}
                    >
                        <IconButton
                            sx={{
                                width: 45,
                                height: 45,
                                backgroundColor: ColorSet.color_000000,
                                ":hover": {
                                    backgroundColor: ColorSet.color_000000,
                                },
                            }}
                        >
                            <Icon
                                icon={IconSet.btn_apple}
                                iconColor={ColorSet.color_ffffff}
                            />
                        </IconButton>
                        <IconButton
                            sx={{
                                width: 45,
                                height: 45,
                                ml: 2,
                                mr: 2,
                                backgroundColor: ColorSet.color_FEE500,
                                ":hover": {
                                    backgroundColor: ColorSet.color_FEE500,
                                },
                            }}
                        >
                            <Icon
                                icon={IconSet.btn_kakao}
                                iconColor={ColorSet.color_000000}
                            />
                        </IconButton>
                        <IconButton
                            sx={{
                                width: 45,
                                height: 45,
                                backgroundColor: ColorSet.color_03C75A,
                                ":hover": {
                                    backgroundColor: ColorSet.color_03C75A,
                                },
                            }}
                        >
                            <Icon
                                icon={IconSet.btn_naver}
                                iconColor={ColorSet.color_ffffff}
                            />
                        </IconButton>
                    </Box>

                    {/* 회원가입 버튼 */}
                    <Box
                        sx={{
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center",
                            mt: 4,

                            mb: { xs: 0, md: 0, lg: 5 },
                        }}
                    >
                        <Button
                            variant="text"
                            sx={{
                                fontSize: "16px",
                                color: ColorSet.color_F16341,
                            }}
                        >
                            일반회원가입
                        </Button>

                        <Box
                            sx={{
                                width: "2px",
                                height: "16px",
                                backgroundColor: ColorSet.color_D2D1D0,
                            }}
                        ></Box>

                        <Button
                            variant="text"
                            sx={{
                                borderRadius: "5px",
                                fontSize: "16px",
                                color: ColorSet.color_F16341,
                            }}
                        >
                            중개사 회원가입
                        </Button>
                    </Box>
                </Card>
            </Box>
        </Box>
    );
}
