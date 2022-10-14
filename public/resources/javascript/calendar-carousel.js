window.onload
{
    const raceSeasonItems = document.querySelectorAll(".calendar-seasons-container");
    const raceSeasonPreviousButton = document.getElementById("calendar-season-previous-button");
    const raceSeasonNextButton = document.getElementById("calendar-season-next-button");
    const seasonTitle = document.getElementById("season-title");

    let raceSeasonMaxSlide = raceSeasonItems.length - 1;
    let raceSeasonCurSlide = raceSeasonMaxSlide;

    function renderSeasonSlides() {

        raceSeasonItems.forEach((item, index) => {
            if (index === raceSeasonCurSlide) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });

        seasonTitle.innerHTML = "Season " + (raceSeasonCurSlide + 1);
    }

    raceSeasonPreviousButton.addEventListener("click", function () {

        if (raceSeasonCurSlide > 0) {
            raceSeasonCurSlide--;
        }

        renderSeasonSlides();
    });

    raceSeasonNextButton.addEventListener("click", function () {

        if (raceSeasonCurSlide < raceSeasonMaxSlide) {
            raceSeasonCurSlide++;
        }

        renderSeasonSlides();
    });

    renderSeasonSlides();

}
