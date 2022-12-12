searchForm = document.getElementById("race-search");

seasonInput = document.getElementById("season-input");
tierInput = document.getElementById("tier-input");

url = searchForm.action.replace("/1/1", "");
console.log(url);

seasonInput.addEventListener('input', ()=> {

    console.log()

    searchForm.action = 'https://vrl/admin/race/' + seasonInput.value + '/' + tierInput.value
})

tierInput.addEventListener('input', ()=> {
    searchForm.action = 'https://vrl/admin/race/' + seasonInput.value + '/' + tierInput.value
})


