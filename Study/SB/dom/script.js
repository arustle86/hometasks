    // let text = document.querySelectorAll (`.text`).style.color=`pink`;

    // text.style.color = `green`;

    document.querySelectorAll(`.text`).forEach(function (element) {
        element.style.color = `pink`;
    })

    let block = document.querySelector(`.block`);

    block.addEventListener(`click`, function () {
        block.classList.add(`translate`);
    });

