function showForm(option) {
    var form = document.querySelector("#" + option);
    form.style.display = "block";
    document.querySelector("#changeOptions").style.display = "none";
    document.querySelector("#goBack").style.display = "block";
}

function hideForm() {
    document.querySelectorAll(".changeForms").forEach(form => {
        form.style.display = "none";
    });
    document.querySelector("#changeOptions").style.display = "block";
    document.querySelector("#goBack").style.display = "none";
}