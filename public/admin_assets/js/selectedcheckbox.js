//Allow for selecting multiple checkbox and to make sure there are no conflict on the script
//if called more than once on a single page
document.getElementById("select-all-checkbox").addEventListener("click", function() {
    let checkboxes = document.querySelectorAll("input[name='selected[]']");
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = !checkbox.checked;
    });
});

document.getElementById("select-all-checkbox-two").addEventListener("click", function() {
    let checkboxes = document.querySelectorAll("input[name='selectedTwo[]']");
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = !checkbox.checked;
    });
});

document.getElementById("select-all-checkbox-three").addEventListener("click", function() {
    let checkboxes = document.querySelectorAll("input[name='selectedThree[]']");
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = !checkbox.checked;
    });
});

document.getElementById("select-all-checkbox-four").addEventListener("click", function() {
    let checkboxes = document.querySelectorAll("input[name='selectedFour[]']");
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = !checkbox.checked;
    });
});
