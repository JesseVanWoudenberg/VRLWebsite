window.onload = function () {

    // Driver controls
    const driverItems = document.querySelectorAll(".standings-driver-table-container");
    const driverPreviousButton = document.getElementById("driver-previous-button");
    const driverNextButton = document.getElementById("driver-next-button");

    let driverMaxSlide = driverItems.length - 1;
    let driverCurSlide = driverMaxSlide;

    function renderDriverSlides() {

        driverItems.forEach((item, index) => {
            if (index === driverCurSlide) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    driverPreviousButton.addEventListener("click", function () {

        if (driverCurSlide > 0) {
            driverCurSlide--;
        }

        renderDriverSlides();
    });

    driverNextButton.addEventListener("click", function () {

        if (driverCurSlide < driverMaxSlide) {
            driverCurSlide++;
        }

        renderDriverSlides();
    });

    renderDriverSlides();

    // Team controls
    const teamItems = document.querySelectorAll(".standings-teams-table-container");
    const teamPreviousButton = document.getElementById("team-previous-button");
    const teamNextButton = document.getElementById("team-next-button");

    let teamMaxSlide = teamItems.length - 1;
    let teamCurSlide = teamMaxSlide;

    function renderTeamSlides() {

        teamItems.forEach((item, index) => {
            if (index === teamCurSlide) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    teamPreviousButton.addEventListener("click", function () {

        if (teamCurSlide > 0) {
            teamCurSlide--;
        }

        renderTeamSlides();
    });

    teamNextButton.addEventListener("click", function () {

        if (teamCurSlide < teamMaxSlide) {
            teamCurSlide++;
        }

        renderTeamSlides();
    });

    renderTeamSlides();

    // Season controls
    const seasonItems = document.querySelectorAll(".standings-container");
    const seasonPreviousButton = document.getElementById("season-previous-button");
    const seasonNextButton = document.getElementById("season-next-button");

    let seasonCurSlide = 0;
    let seasonMaxSlide = seasonItems.length - 1;

    function renderSeasonSlides() {

        seasonItems.forEach((item, index) => {
            if (index === seasonCurSlide) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    seasonPreviousButton.addEventListener("click", function () {

        if (seasonCurSlide > 0) {

            seasonCurSlide--;

        }

        renderSeasonSlides();
    });

    seasonNextButton.addEventListener("click", function () {

        if (seasonCurSlide < seasonMaxSlide) {

            seasonCurSlide++;

        }

        renderSeasonSlides();
    });

    renderSeasonSlides();

}
