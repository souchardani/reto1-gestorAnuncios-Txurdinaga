function menu() {
    var x = document.getElementById("dropdown-content");
    window.addEventListener('mouseup',function(event){
    if (event.target != x && event.target.parentNode != x) {
        x.style.display = 'none';
    }
    });
    if (x.style.display === "none") {
        x.style.display = "block";
    }
}