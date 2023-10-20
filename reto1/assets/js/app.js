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
let modelCarr

let fotos = [
    "../reto1/img/anuncios/administracion1-1024x683.jpg",
    "../reto1/img/anuncios/Comercio_chicas-scaled.jpg",
    "../reto1/img/anuncios/davide-cantelli-e3Uy4k7ooYk-unsplash.jpg",
    "../reto1/img/anuncios/electronica1-1024x683.jpg",
    "../reto1/img/anuncios/marketing-1024x683.jpg"
]

function initCarr(){
    // Se establece el modelo inicial
    modelCarr = 0;
    // Se llama a la primera vista con el modelo inicial
    viewCarr();
}

var myTimeout = setTimeout(timer, 10000);
function updateCarr(action){
    
    if(action=="left"){
        modelCarr = modelCarr - 1
        myTimeout = setTimeout(timer, 10000);
    }
    if(action=="right"){
        modelCarr = modelCarr + 1
        myTimeout = setTimeout(timer, 10000);
    }
    if(modelCarr < 0){
        modelCarr = fotos.length - 1
    }
    if(modelCarr == fotos.length){
        modelCarr = 0
    }
    clearTimeout(myTimeout);
    viewCarr();
}

function timer() {
    document.getElementById("right").click()
    clearTimeout(myTimeout);
    myTimeout = setTimeout(timer, 10000);
}

function viewCarr(){
    document.getElementById("carrusel").innerHTML = 
    `
        <button id="left" onclick="updateCarr('left');"> < </button>
            <img src="${fotos[modelCarr]}" alt="">
        <button id="right" onclick="updateCarr('right');"> > </button>
    `;
}

function init(){
    initCarr();
}