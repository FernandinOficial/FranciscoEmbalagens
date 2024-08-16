//carrosel
const imgs = document.getElementById("img");
const img = document.querySelectorAll("#img .banner");

let idx = 0;

function carrossel(){
    idx++;

    if(idx > img.length - 1){
        idx = 0;
    }

    imgs.style.transform = `translateX(${-idx * 320}px)`;
}

setInterval(carrossel, 7000)