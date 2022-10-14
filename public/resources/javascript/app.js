const menubutton = document.querySelector('.menu-button');
const nav = document.querySelector('.private-navigation');
const main = document.querySelector('.main-container');

const navFunctionality = () => {

    if(localStorage.getItem('menu-open') === "true") {
        nav.classList.add('nav-active');
        menubutton.classList.add('toggle');
        main.classList.add('main-nav-active')
    } else {
        nav.classList.add('page-open');
        main.classList.add('page-open');

    }

    menubutton.addEventListener('click',()=>{

        //Toggle nav
        nav.classList.toggle('nav-active');
        menubutton.classList.toggle('toggle');
        main.classList.toggle('main-nav-active')

        if(localStorage.getItem('menu-open') === "true") {
            localStorage.setItem('menu-open', "false")
            console.log(localStorage.getItem('menu-open'))
        } else {
            localStorage.setItem('menu-open', "true")
            console.log(localStorage.getItem('menu-open'))
        }
    });
}

const standingsFunctionality = () => {

}

standingsFunctionality()
navFunctionality();

