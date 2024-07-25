var btn = document.querySelector('#dropbtn');
var dropdownContainer = document.querySelector('.dropdown-container');

btn = addEventListener('click', function(){
    if(dropdownContainer.style.display === 'block'){
        dropdownContainer.style.display = 'none';
    }else{
        dropdownContainer.style.display = 'block';
    }
});