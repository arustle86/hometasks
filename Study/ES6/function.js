"use strict"

function agreeCookies (question, yes, no) {
    if (confirm(question)) yes();
    else no();
}
agreeCookies ("Наш сайт использует cookies, требуется Ваше согласие чтобы продолжить",
    function () {
        console.log("Вы согласились");
    },
        function () {
            console.log("Вы отказались");
        }
);
