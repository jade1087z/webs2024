import React from "react";

const Bar = () => {
    return (
        <div id="search">
            <div className="search__inner">
                <label htmlFor="searchInput">검색</label>
                <input
                    type="search"
                    id="searchInput"
                    placeholder="검색어를 입력해주세요!"
                    className="search__input"
                />
            </div>
        </div>
    );
};

export default Bar;
