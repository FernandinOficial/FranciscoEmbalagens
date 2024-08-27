//header
// var dropBtn = document.querySelector('#dropbtn');
// var dropdownContent = document.querySelector('.dropdown-content');

// dropBtn.addEventListener('click', function () {
//     if (dropdownContent.style.display === 'block') {
//         dropdownContent.style.display = 'none';
//     } else {
//         dropdownContent.style.display = 'block';
//     }
// });

// POPUP SOBRE
function togglePopup() {
  document.getElementById("popup-1").classList.toggle("active");

  // Desfocar o main quando o popup estiver ativo
  const mainElement = document.querySelector("main");
  
  if (document.getElementById("popup-1").classList.contains("active")) {
    mainElement.style.filter = "blur(5px)";
  } else {
    mainElement.style.filter = "none";
  }
}
