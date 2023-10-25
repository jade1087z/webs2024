import { useEffect } from "react";
import { useLocation } from "react-router-dom";

const ScrollTo = () => {
    const { pathname } = useLocation();

    useEffect(() => {
        window.scrollTo(0, 0);

    }, [pathname]); // pathname에 변화가 있으면 동작이 실행됨 
}

export default ScrollTo;