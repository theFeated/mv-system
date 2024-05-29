//Close the modal
$(document).ready(function(){
    // Close modal on button click
    $(".btn").click(function(){
        $(".my-modal").modal('hide');
    });
    
    // Close modal on close button click
    $(".close-modal").click(function(){
        $(".my-modal").modal('hide');
    });
});