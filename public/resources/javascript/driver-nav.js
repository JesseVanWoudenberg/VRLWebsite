driverMenuToggle = document.querySelector('#driver-menu-toggle');
driverNav = document.querySelector("#driver-nav");

driverNavFunctionality = () => {

    if (localStorage.getItem('driver-menu') === "true") {
        driverNav.classList.add('driver-panel-nav-non-active');
    }

    driverMenuToggle.addEventListener("click", () => {

        console.log(driverMenuToggle);

        //Toggle nav
        driverNav.classList.toggle('driver-panel-nav-non-active');

        if (localStorage.getItem('driver-menu') === "true") {
            localStorage.setItem('driver-menu', "false")
        } else {
            localStorage.setItem('driver-menu', "true")
        }
    });
};



driverNavFunctionality();
