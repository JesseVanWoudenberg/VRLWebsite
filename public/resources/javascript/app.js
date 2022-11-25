const menubutton = document.querySelector('.menu-button');
const nav = document.querySelector('.private-navigation');
const main = document.querySelector('.main-container');

const adminButton = document.getElementById('admin-button');
const adminDropdown = document.getElementById('admin-dropdown');

const fiaButton = document.getElementById('fia-button');
const fiaDropdown = document.getElementById('fia-dropdown');

const reporterButton = document.getElementById('reporter-button');
const reporterDropdown = document.getElementById('reporter-dropdown');

const championshipsButton = document.getElementById('championships-button');
const championshipsDropdown = document.getElementById('championships-dropdown');

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
        } else {
            localStorage.setItem('menu-open', "true")
        }
    });
}

const collapseAllCategories = () => {
    adminDropdown.classList.remove('activated');
    fiaDropdown.classList.remove('activated');
    reporterDropdown.classList.remove('activated');
    championshipsDropdown.classList.remove('activated');

    localStorage.setItem('adminDropdown-open', "false");
    localStorage.setItem('fiaDropdown-open', "false");
    localStorage.setItem('reporterDropdown-open', "false");
    localStorage.setItem('championshipsDropdown-open', "false");
}

const navCategoriesFunctionality = () => {

    if(localStorage.getItem('adminDropdown-open') === "true") {
        adminDropdown.classList.add('activated');
    }
    if(localStorage.getItem('fiaDropdown-open') === "true") {
        fiaDropdown.classList.add('activated');
    }
    if(localStorage.getItem('reporterDropdown-open') === "true") {
        reporterDropdown.classList.add('activated');
    }
    if(localStorage.getItem('championshipsDropdown-open') === "true") {
        championshipsDropdown.classList.add('activated');
    }

    adminButton.addEventListener('click', () => {
        let active = adminDropdown.classList.contains('activated');

        collapseAllCategories();

        if (!active) {
            adminDropdown.classList.add('activated');
            localStorage.setItem('adminDropdown-open', "true");
        } else {
            localStorage.setItem('adminDropdown-open', "false");
        }
    })

    fiaButton.addEventListener('click', () => {
        let active = fiaDropdown.classList.contains('activated');

        collapseAllCategories();

        if (!active) {
            fiaDropdown.classList.add('activated');
            localStorage.setItem('fiaDropdown-open', "true");
        } else {
            localStorage.setItem('fiaDropdown-open', "false");
        }
    })

    reporterButton.addEventListener('click', () => {
        let active = reporterDropdown.classList.contains('activated');

        collapseAllCategories();

        if (!active) {
            reporterDropdown.classList.add('activated');
            localStorage.setItem('reporterDropdown-open', "true");
        } else {
            localStorage.setItem('reporterDropdown-open', "false");
        }
    })

    championshipsButton.addEventListener('click', () => {
        let active = championshipsDropdown.classList.contains('activated');

        collapseAllCategories();

        if (!active) {
            championshipsDropdown.classList.add('activated');
            localStorage.setItem('championshipsDropdown-open', "true");
        } else {
            localStorage.setItem('championshipsDropdown-open', "false");
        }
    })
}

navCategoriesFunctionality()
navFunctionality();
