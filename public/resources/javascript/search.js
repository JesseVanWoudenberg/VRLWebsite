searchForm = document.getElementById("race-search");

seasonInput = document.getElementById("season-input");
tierInput = document.getElementById("tier-input");

url = searchForm.action.replace("1/1", "");

seasonInput.addEventListener('input', ()=> {

    console.log()

    searchForm.action = url + seasonInput.value + '/' + tierInput.value
})

tierInput.addEventListener('input', ()=> {
    searchForm.action = url + seasonInput.value + '/' + tierInput.value
})


