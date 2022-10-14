window.onload
{

// Driver controls
    const items = document.querySelectorAll(".results-container");

    let currentSlide = 0;

    function renderContainers() {

        items.forEach((item, index) => {
            if (index === currentSlide) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    if (document.getElementById("race-results-show-button") != null) {

        const raceResultsButton = document.getElementById("race-results-show-button");

        raceResultsButton.addEventListener("click", function () {
            currentSlide = 1;
            renderContainers();
        });


    }

    if (document.getElementById("fastest-lap-show-button") != null) {

        const fastestLapButton = document.getElementById("fastest-lap-show-button");

        fastestLapButton.addEventListener("click", function () {
            currentSlide = 0;
            renderContainers();
        });
    }

    if (document.getElementById("full-qualifying-show-button") != null) {

        const fullQualifyingButton = document.getElementById("full-qualifying-show-button");

        fullQualifyingButton.addEventListener("click", function () {
            currentSlide = 2;
            renderContainers();
        });
    }

    if (document.getElementById("short-qualifying-show-button") != null) {

        const shortQualifyingButton = document.getElementById("short-qualifying-show-button");

        shortQualifyingButton.addEventListener("click", function () {
            currentSlide = 2;
            renderContainers();
        });
    }

    renderContainers();

}
