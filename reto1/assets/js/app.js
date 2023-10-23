// Menu Perfil
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

// Carrusel

var myTimeout = setTimeout(timer, 10000);
function updateCarr(action){

    let item = document.querySelectorAll('.item');

    if(action == "next"){
        document.getElementById('slide').appendChild(item[0]);
    }

    if(action == "prev"){
        document.getElementById('slide').prepend(item[item.length - 1]);
    }
    
}

function timer() {
    document.getElementById("next").click()
    clearTimeout(myTimeout);
    var myTimeout = setTimeout(timer, 10000);
}