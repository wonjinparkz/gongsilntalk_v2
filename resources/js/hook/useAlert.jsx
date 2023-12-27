import {
    Button,
    Dialog,
    DialogActions,
    DialogContent,
    DialogContentText,
    DialogTitle,
} from "@mui/material";
import { useState } from "react";

export const useAlert = () => {
    const [open, setOpen] = useState(false);
    const [title, setTitle] = useState("");
    const [message, setMessage] = useState("");
    const [confirm, setConfirm] = useState();

    const showDialog = () => setOpen(true);
    const confirmDialog = () => {
        confirm();
        setOpen(false);
    };
    const cancelDialog = () => setOpen(false);

    const getProps = ({ title, message, confirm }) => {
        setTitle(title);
        setMessage(message);
        setConfirm(confirm);
        showDialog();
    };

    const AlertDialog = () => {
        return (
            <Dialog
                open={true}
                onClose={handleClose}
                aria-labelledby="alert-dialog-title"
                aria-describedby="alert-dialog-description"
            >
                <DialogTitle id="alert-dialog-title">{title}</DialogTitle>
                <DialogContent>
                    <DialogContentText id="alert-dialog-description">
                        {message}
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button onClick={cancelDialog}>취소</Button>
                    <Button onClick={confirmDialog} autoFocus>
                        확인
                    </Button>
                </DialogActions>
            </Dialog>
        );
    };

    return [AlertDialog, open, getProps];
};
