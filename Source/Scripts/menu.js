var subNavbar = document.querySelector('.sub-navbar');
var oneNavbar = document.querySelector('.one-navbar');
var oneSubNavbar = document.querySelector('.one-sub-navbar');
var open = false;

closeMenu();

function openSubMenu() {
    if (open) {
        closeMenu();
    } else {
        subNavbar.style.display = 'block';
        oneSubNavbar.style.display = 'none';
        oneNavbar.style.display = 'none';

        open = true;
    }
}

function openOneNav() {
    subNavbar.style.display = 'block';
    oneNavbar.style.display = 'block';
    oneSubNavbar.style.display = 'none';
}

function openOneSubNav() {
    subNavbar.style.display = 'block';
    oneNavbar.style.display = 'block';
    oneSubNavbar.style.display = 'block';
}

function closeSubMenu() {
    subNavbar.style.display = 'none';
}

function closeOneNav() {
    oneNavbar.style.display = 'none';
}

function closeOneSubNav() {
    oneSubNavbar.style.display = 'none';
}

function closeMenu() {
    subNavbar.style.display = 'none';
    oneNavbar.style.display = 'none';
    oneSubNavbar.style.display = 'none';
    open = false;
}