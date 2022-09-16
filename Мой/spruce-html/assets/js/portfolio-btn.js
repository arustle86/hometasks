const btnMore = document.querySelector(".portfolio-btn");
const gridItem = document.querySelectorAll(".grid-item");


btnMore.addEventListener("click", () => {
    gridItem.forEach(el => { el.classList.add("grid-item--visible")});
    btnMore.closest("btn-more").classList.add("btn-more--hidden");
})