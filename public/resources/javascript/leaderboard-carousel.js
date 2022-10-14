window.onload
{

// Driver controls
    const leaderboardItems = document.querySelectorAll(".leaderboard-container");

    const pointsButton = document.getElementById("points-button");
    const wdcButton = document.getElementById("wdc-button");
    const winsButton = document.getElementById("wins-button");
    const podiumsButton = document.getElementById("podiums-button");
    const polesButton = document.getElementById("poles-button");
    const fastestLapsButton = document.getElementById("fastest-laps-button");
    const raceStartsButton = document.getElementById("race-starts-button");

    let leaderboardCurrentSlide = 0;

    function renderSlides() {

        leaderboardItems.forEach((item, index) => {
            if (index === leaderboardCurrentSlide) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    pointsButton.addEventListener("click", function () {
        leaderboardCurrentSlide = 0
        renderSlides();
    });

    wdcButton.addEventListener("click", function () {
        leaderboardCurrentSlide = 1
        renderSlides();
    });

    winsButton.addEventListener("click", function () {
        leaderboardCurrentSlide = 2
        renderSlides();
    });

    podiumsButton.addEventListener("click", function () {
        leaderboardCurrentSlide = 3
        renderSlides();
    });

    polesButton.addEventListener("click", function () {
        leaderboardCurrentSlide = 4
        renderSlides();
    });

    fastestLapsButton.addEventListener("click", function () {
        leaderboardCurrentSlide = 5
        renderSlides();
    });

    raceStartsButton.addEventListener("click", function () {
        leaderboardCurrentSlide = 6
        renderSlides();
    });

    renderSlides();
}
