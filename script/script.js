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