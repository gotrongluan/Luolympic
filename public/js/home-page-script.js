let introNav = document.getElementsByClassName("intro-navigation")[0];
let introCtns = document.getElementsByClassName("intro-container");
let count = document.getElementById("count");
let curImage = 0;
let prevBtn = introNav.firstElementChild, nextBtn = introNav.lastElementChild;
prevBtn.addEventListener("click", function ( event ) {
    introCtns[curImage].style.display = "none";
    curImage = (curImage == 0) ? 2 : (curImage - 1);
    introCtns[curImage].style.display = "block";
    count.innerHTML = curImage + 1 + "/3";
});

nextBtn.addEventListener("click", function ( event ) {
    introCtns[curImage].style.display = "none";
    curImage = (curImage == 2) ? 0 : (curImage + 1);
    introCtns[curImage].style.display = "block";
    count.innerHTML = curImage + 1 + "/3";
});

let classesSelect = document.getElementsByClassName("classes");
for (let j = 0; j < classesSelect.length; ++j) {
    for (let i = 1; i <= 12; ++i) {
        let newOp = document.createElement("OPTION");
        newOp.value = i;
        if (i == 1)
            newOp.selected = true;
        newOp.innerHTML = "Lớp " + i;
        classesSelect[j].appendChild(newOp);
    }
}