console.log("js font sizes");

const classes = ["f0", "f1", "f2", "f3", "f4"];
let classIndex = 2;

document.getElementById("aumentar").addEventListener("click", function () {
    let previousClass = classIndex;
    classIndex++;
    classIndex = classIndex == classes.length ? classes.length - 1 : classIndex;
    changeClass(previousClass, classIndex);
});
document.getElementById("disminuir").addEventListener("click", function () {
    let previousClass = classIndex;
    classIndex--;
    classIndex = classIndex < 0 ? 0 : classIndex;
    changeClass(previousClass, classIndex);
});

function changeClass(previous, next) {
    if (previous != next) {
        var htmlElement = document.querySelector("html");
        htmlElement.classList.remove(classes[previous]);
        htmlElement.classList.add(classes[next]);
    }
}
