 // Function to display SweetAlert dialog with dynamic message
    function showConfirmationDialog(message, callback) {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, proceed!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true,
            customClass: {
                confirmButton: 'btn btn-primary border',
                cancelButton: 'btn btn-secondary border'
            },
            width: '300px',
            heightAuto: false,
            height: '200px',
            didOpen: () => {
                Swal.getPopup().style.border = '2px solid #fff';
            }
        }).then(function(result) {
            if (result.value) {
                callback(); // Call the callback function if user confirms
            }
        });
    }

    // Event listener for all archive buttons
    var archiveButtons = document.querySelectorAll('.archive-button');
    archiveButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Get the message from the data attribute
            var message = this.getAttribute('data-message');

            // Call the showConfirmationDialog function with the dynamic message
            showConfirmationDialog(message, function() {
                // Callback function to submit the form if user confirms
                button.closest('.archive-form').submit();
            });
        });
    });