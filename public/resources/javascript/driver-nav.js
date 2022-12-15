driverMenuToggle = document.querySelector('#driver-menu-toggle');
driverNav = document.querySelector("#driver-nav");
driverMain = document.querySelector(".driver-main");

driverNavFunctionality = () => {

    if (localStorage.getItem('driver-menu') === "true") {
        driverNav.classList.add('driver-panel-nav-non-active');
        driverMain.classList.add('collapsed');
    }

    driverMenuToggle.addEventListener("click", () => {
        //Toggle nav
        driverNav.classList.toggle('driver-panel-nav-non-active');
        driverMain.classList.toggle('collapsed');

        if (localStorage.getItem('driver-menu') === "true") {
            localStorage.setItem('driver-menu', "false")
        } else {
            localStorage.setItem('driver-menu', "true")
        }
    });
};



driverNavFunctionality();
