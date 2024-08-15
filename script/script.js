//header
var dropBtn = document.querySelector('#dropbtn');
var dropdownContent = document.querySelector('.dropdown-content');

dropBtn.addEventListener('click', function () {
    if (dropdownContent.style.display === 'block') {
        dropdownContent.style.display = 'none';
    } else {
        dropdownContent.style.display = 'block';
    }
});

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