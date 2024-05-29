//Display the items on te dashboard page on click
$(document).ready(function() {
    $('.list-group-item-action').click(function() {
        $('.list-group-item-action').removeClass('active');
        $(this).addClass('active');

        // Check which item was clicked and show corresponding content
        var id = $(this).attr('id');
        if (id === 'researchLink') {
            $('#researchInfoBox').show();
            $('#researchChartCard').show();
            // Call a function to fetch and display research data here
        } else if (id === 'researcherLink') {
            // Show researcher content
        }
    });
});

//Going to the archive page of the research will display the research details on default
$(document).ready(function() {
    // Show Research Form by default
    $('#researchForm').show();
    // Hide other forms
    $('#monitoringsForm, #externalFundsForm, #roleResearchAssignedForm').hide();
});

// Show all button showing all items that are present on the current page
function showAllArchivedItems() {
    $('#researchForm, #monitoringsForm, #externalFundsForm, #roleResearchAssignedForm').show();
}

    // Function to trigger the file input element for capturing an image
    function openCamera() {
        document.getElementById('profile_image').click();
    }

