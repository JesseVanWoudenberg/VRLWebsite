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
            console.log(localStorage.getItem('menu-open'))
        } else {
            localStorage.setItem('menu-open', "true")
            console.log(localStorage.getItem('menu-open'))
        }
    });
}

const collapseAllCategories = () => {
    adminDropdown.classList.remove('activated');
    fiaDropdown.classList.remove('activated');
    reporterDropdown.classList.remove('activated');
    championshipsDropdown.classList.remove('activated');
}

const navCategoriesFunctionality = () => {

    adminButton.addEventListener('click', () => {
        let active = adminDropdown.classList.contains('activated');

        collapseAllCategories();

        if (!active) {
            adminDropdown.classList.add('activated');
        }
    })

    fiaButton.addEventListener('click', () => {
        let active = fiaDropdown.classList.contains('activated');

        collapseAllCategories();

        if (!active) {
            fiaDropdown.classList.add('activated');
        }
    })

    reporterButton.addEventListener('click', () => {
        let active = reporterDropdown.classList.contains('activated');

        collapseAllCategories();

        if (!active) {
            reporterDropdown.classList.add('activated');
        }
    })

    championshipsButton.addEventListener('click', () => {
        let active = championshipsDropdown.classList.contains('activated');

        collapseAllCategories();

        if (!active) {
            championshipsDropdown.classList.add('activated');
        }
    })

    // adminDropdown.style.display = 'none';
    //
    // adminButton.addEventListener('click', ()=> {
    //
    //     if (adminDropdown.style.display === 'none') {
    //
    //         collapseAllCategories();
    //         adminDropdown.style.display = 'block';
    //
    //     } else {
    //
    //         adminDropdown.style.display = 'none';
    //
    //     }
    //
    // })
    //
    // fiaDropdown.style.display = 'none';
    //
    // fiaButton.addEventListener('click', ()=> {
    //
    //     if (fiaDropdown.style.display === 'none') {
    //
    //         collapseAllCategories();
    //         fiaDropdown.style.display = 'block';
    //
    //     } else {
    //
    //         fiaDropdown.style.display = 'none';
    //
    //     }
    // })
    //
    // // Reporter button functionality
    // reporterDropdown.style.display = 'none';
    //
    // reporterButton.addEventListener('click', ()=> {
    //
    //     collapseAllCategories();
    //     reporterDropdown.classList.toggle('activated');
    //
    // })
    //
    // // Championships button functionality
    // championshipsDropdown.style.display = 'none';
    //
    // championshipsButton.addEventListener('click', ()=> {
    //
    //     if (championshipsDropdown.style.display === 'none') {
    //
    //         collapseAllCategories();
    //         championshipsDropdown.style.display = 'block';
    //
    //     } else {
    //
    //         championshipsDropdown.style.display = 'none';
    //
    //     }
    // })
}

navCategoriesFunctionality()
navFunctionality();

