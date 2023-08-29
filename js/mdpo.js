
function showDiv(divId) {
    var divToShow = document.getElementById(divId);
    var allDivs = document.getElementsByClassName("content");

    for (var i = 0; i < allDivs.length; i++) {
        allDivs[i].style.display = "none";
    }

    divToShow.style.display = "block";
}
