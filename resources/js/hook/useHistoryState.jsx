import { useState, useCallback } from "react";

const useHistoryState = (initialState, options = {}) => {
    const [State, setState] = useState(initialState);
    const [History, setHistory] = useState([initialState]);
    const [Pointer, setPointer] = useState(0);

    const ChangeState = useCallback(
        (value) => {
            if (value === History[History.length - 1]) return false;

            setState(value);

            setHistory((history) => {
                if (Pointer === history.length - 1) return [...history, value];

                return [...history.slice(0, Pointer + 1), value];
            });

            setPointer((pointer) => pointer + 1);

            if (options.onChangeState) {
                options.onChangeState(History[Pointer], value);
            }

            return true;
        },
        [History, options, Pointer]
    );

    const Undo = useCallback(() => {
        if (Pointer === 0) return false;

        setState(History[Pointer - 1]);

        setPointer((pointer) => pointer - 1);

        if (options.onUndo) {
            options.onUndo(History[Pointer], History[Pointer - 1]);
        }

        return true;
    }, [History, Pointer, options]);

    const Redo = useCallback(() => {
        if (Pointer === History.length - 1) return false;

        setState(History[Pointer + 1]);

        setPointer((pointer) => pointer + 1);

        if (options.onRedo) {
            options.onRedo(History[Pointer], History[Pointer + 1]);
        }

        return true;
    }, [History, Pointer, options]);

    const ClearHistory = useCallback(() => {
        setHistory([State]);
        setPointer(0);

        if (options.onClearHistory) {
            options.onClearHistory(History, [State]);
        }

        return true;
    }, [History, State, options]);

    return [State, ChangeState, [Undo, Redo, ClearHistory, History]];
};

export default useHistoryState;
