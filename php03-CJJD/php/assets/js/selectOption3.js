/* 화살표 함수 */
window.addEventListener("DOMContentLoaded", () => {
    const title = document.querySelector(".board_title h2");
    const submit = document.querySelector(".create h2");
    const selectBox3 = document.querySelector(".selectBox3");
    const label = selectBox3.querySelector(".label");
    const options = selectBox3.querySelectorAll(".optionItem");
    const icon3 = selectBox3.querySelector(".selectBox3 i");

    // 클릭한 옵션의 텍스트를 라벨 안에 넣음
    const handleSelect = (item) => {
        label.parentNode.classList.remove("active");
        label.innerHTML = item.textContent;
        title.innerHTML = item.textContent;
        // submit.innerHTML = item.textContent;
    };
    // 옵션 클릭시 클릭한 옵션을 넘김
    options.forEach((option) => {
        option.addEventListener("click", () => {
            handleSelect(option);
            console.log(option);
            console.log(option.textContent);
            document.getElementById("boardCategory").value = option.textContent;
            console.log(document.getElementById("boardCategory").value);
        });
    });

    // 라벨을 클릭시 옵션 목록이 열림/닫힘
    label.addEventListener("click", (event) => {
        event.preventDefault();
        if (label.parentNode.classList.contains("active")) {
            label.parentNode.classList.remove("active");
            console.log("dd");
        } else {
            console.log("d");
            label.parentNode.classList.add("active");
        }
    });

    icon3.addEventListener("click", () => {
        if (label.parentNode.classList.contains("active")) {
            label.parentNode.classList.remove("active");
        } else {
            label.parentNode.classList.add("active");
        }
    });
});
