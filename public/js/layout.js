const cargarValores = () => {
    console.log("layout principalaa");
    themesClasses.forEach((c) => {
        document.body.classList.remove(c);
    });
    const bodyTheme = localStorage.getItem("theme") || "adult-lm";
    cargarOptions(bodyTheme);
    console.log(bodyTheme);
    document.body.classList.add(bodyTheme);
};

const cargarOptions = (bodyTheme) => {
    let themeSelect = document.getElementById("theme-select");
    let adultos = new Option("Adultos", "1");
    let juvenil = new Option("Juvenil", "2");
    let kid = new Option("Niños", "3");
    switch (bodyTheme) {
        case themes.adult_lm:
        case themes.adult_dm:
            themeSelect.add(adultos, undefined);
            themeSelect.add(juvenil, undefined);
            themeSelect.add(kid, undefined);
            break;
        case themes.youth_lm:
        case themes.youth_dm:
            themeSelect.add(juvenil, undefined);
            themeSelect.add(adultos, undefined);
            themeSelect.add(kid, undefined);
            break;
        case themes.kid_lm:
        case themes.kid_dm:
            themeSelect.add(kid, undefined);
            themeSelect.add(adultos, undefined);
            themeSelect.add(juvenil, undefined);
            break;
        default:
            break;
    }
    let newOption = new Option("Option Text", "Option Value");
};

window.onload = cargarValores;
let autoSwitch = true;
//lm: light-mode, dm: dark-mode
const themes = {
    kid_lm: "kid-lm",
    kid_dm: "kid-dm",
    youth_lm: "youth-lm",
    youth_dm: "youth-dm",
    adult_lm: "adult-lm",
    adult_dm: "adult-dm",
};

const themesClasses = [
    "kid-lm",
    "kid-dm",
    "youth-lm",
    "youth-dm",
    "adult-lm",
    "adult-dm",
];

const btnSwitch = document.querySelector("#switch");

const switchTheme = () => {
    autoSwitch = false;
    let bodyClass = document.body.classList;
    //console.log(bodyClass[0]);
    switch (bodyClass[0]) {
        case themes.adult_lm:
            document.body.classList.remove(themes.adult_lm);
            document.body.classList.add(themes.adult_dm);
            localStorage.setItem("theme", themes.adult_dm);
            break;
        case themes.adult_dm:
            document.body.classList.remove(themes.adult_dm);
            document.body.classList.add(themes.adult_lm);
            localStorage.setItem("theme", themes.adult_lm);
            break;
        case themes.youth_lm:
            document.body.classList.remove(themes.youth_lm);
            document.body.classList.add(themes.youth_dm);
            localStorage.setItem("theme", themes.youth_dm);
            break;
        case themes.youth_dm:
            document.body.classList.remove(themes.youth_dm);
            document.body.classList.add(themes.youth_lm);
            localStorage.setItem("theme", themes.youth_lm);
            break;
        case themes.kid_lm:
            document.body.classList.remove(themes.kid_lm);
            document.body.classList.add(themes.kid_dm);
            localStorage.setItem("theme", themes.kid_dm);
            break;
        case themes.kid_dm:
            document.body.classList.remove(themes.kid_dm);
            document.body.classList.add(themes.kid_lm);
            localStorage.setItem("theme", themes.kid_lm);
            break;

        default:
            break;
    }
};

btnSwitch.addEventListener("click", switchTheme);

const actualizarTheme = () => {
    console.log("actualizar tema");
    //* obtener el valor del select para cambiar theme. Si es 1:adulto, 2:juvenil, 3:niño
    let themeSelect = document.getElementById("theme-select").value;
    console.log(themeSelect);

    //* eliminar las demás clases que podría tener el body
    themesClasses.forEach((c) => {
        document.body.classList.remove(c);
    });

    //* cambiar la clase del body. Por defecto cambiar al modo día del tema seleccionado
    switch (themeSelect) {
        case "1":
            document.body.classList.toggle(themes.adult_lm);
            localStorage.setItem("theme", themes.adult_lm);
            break;
        case "2":
            document.body.classList.toggle(themes.youth_lm);
            localStorage.setItem("theme", themes.youth_lm);
            break;
        case "3":
            document.body.classList.toggle(themes.kid_lm);
            localStorage.setItem("theme", themes.kid_lm);
            break;
        default:
            break;
    }
};

const switchToDarkTheme = () => {
    if (!autoSwitch) return;
    let bodyClass = document.body.classList;
    switch (bodyClass[0]) {
        case themes.adult_lm:
            document.body.classList.remove(themes.adult_lm);
            document.body.classList.add(themes.adult_dm);
            localStorage.setItem("theme", themes.adult_dm);
            break;
        case themes.youth_lm:
            document.body.classList.remove(themes.youth_lm);
            document.body.classList.add(themes.youth_dm);
            localStorage.setItem("theme", themes.youth_dm);
            break;
        case themes.kid_lm:
            document.body.classList.remove(themes.kid_lm);
            document.body.classList.add(themes.kid_dm);
            localStorage.setItem("theme", themes.kid_dm);
            break;

        default:
            break;
    }
};

const switchToLightTheme = () => {
    if (!autoSwitch) return;
    let bodyClass = document.body.classList;
    switch (bodyClass[0]) {
        case themes.adult_dm:
            document.body.classList.remove(themes.adult_dm);
            document.body.classList.add(themes.adult_lm);
            localStorage.setItem("theme", themes.adult_lm);
            break;
        case themes.youth_dm:
            document.body.classList.remove(themes.youth_dm);
            document.body.classList.add(themes.youth_lm);
            localStorage.setItem("theme", themes.youth_lm);
            break;
        case themes.kid_dm:
            document.body.classList.remove(themes.kid_dm);
            document.body.classList.add(themes.kid_lm);
            localStorage.setItem("theme", themes.kid_lm);
            break;

        default:
            break;
    }
};

setInterval(function timeChecker() {
    let newTime = new Date();
    let limitTime = "20:00:00";
    console.log(newTime.toLocaleTimeString());
    if (newTime.toLocaleTimeString() > limitTime) {
        console.log("cambio de tema");
        switchToDarkTheme();
    } else {
        switchToLightTheme();
    }
}, 5000);
