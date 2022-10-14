window.onload
{

// Driver controls
    const qualifyingItems = document.querySelectorAll(".qualifying-results");
    const qualifyingPreviousButton = document.getElementById("qualifying-previous-button");
    const qualifyingNextButton = document.getElementById("qualifying-next-button");

    let qualifyingMaxSlide = qualifyingItems.length - 1;
    let qualifyingCurSlide = 0;

    function renderQualifyingSlides() {

        qualifyingItems.forEach((item, index) => {
            if (index === qualifyingCurSlide) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    qualifyingPreviousButton.addEventListener("click", function () {

        if (qualifyingCurSlide > 0) {
            qualifyingCurSlide--;
        }

        renderQualifyingSlides();
    });

    qualifyingNextButton.addEventListener("click", function () {

        if (qualifyingCurSlide < qualifyingMaxSlide) {
            qualifyingCurSlide++;
        }

        renderQualifyingSlides();
    });

    renderQualifyingSlides();

}
