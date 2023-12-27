import { useState, useCallback } from "react";
import { useLocation, useNavigate } from "react-router-dom";

const useHistoryState = (initialState, key) => {
    const history = useNavigate();
    const location = useLocation();
    const stateValue = location.state?.[key];

    const [historyState, setHistoryState] = useState(
        stateValue === undefined ? initialState : stateValue
    );

    const setState = useCallback(
        (state, replace = false) => {
            const value =
                state instanceof Function ? state(historyState) : state;

            setHistoryState(() => value);

            history(
                {
                    state: replace
                        ? value
                        : { ...location.state, [key]: value },
                },
                { replace: true }
            );
        },
        [history, historyState, key]
    );

    return [historyState, setState];
};

export default useHistoryState;
