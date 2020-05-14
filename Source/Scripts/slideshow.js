var slideIndex = 1;
showSlide('.slide');

function move(name) {
    let x;

    x = document.querySelectorAll(name);

    x[slideIndex].style.display = 'none';

    if (slideIndex == 0) {
        slideIndex = 1;
    } else {
        slideIndex = 0;
    }

    x[slideIndex].style.display = 'block';
}

function showSlide(name) {
    let x;

    x = document.querySelectorAll(name);
    console.log(x);

    for (let i = 0; i < x.length; i++) {
        let y = document.querySelector('#' + x[i].id + '.slide');
        console.log(y);
        y.style.display = 'none';
    }

    x[slideIndex].style.display = 'block';
}