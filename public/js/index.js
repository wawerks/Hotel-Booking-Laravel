$(document).ready(function() {
    console.log("Document is ready."); // Check if this runs

    $('#browse-btn').click(function() {
        console.log("Browse button clicked."); // Check if the button click is registered
        $('#hotel-list-section').slideToggle();
    });

    // Log when details are clicked
    $('.details').on('click', function(e) {
        e.stopPropagation(); // Prevents the click from bubbling up

        // Get the hotel name from the closest anchor element
        var hotelName = $(this).closest('.img-container').find('a').data('hotel'); 
        console.log("Details clicked for: " + hotelName); // Log hotel name

        // Set the hotel name in the modal and show it
        $('#availabilityModal').modal('show');
        $('#availabilityModal').data('hotel-name', hotelName).find('.modal-title').text('Check Availability for ' + hotelName);
        $('#availabilityModal').find('#selected-hotel').val(hotelName);
        
        // Update hotel location
        var hotelLocations = {
            "Oasis Hotel": "Butuan City, Philippines",
            "Inland Hotel": "Butuan City, Philippines",
            "Watergate Hotel": "Butuan City, Philippines",
            "Hotel 4": "Butuan City, Philippines",
            "Hotel 5": "Butuan City, Philippines",
            "Hotel 6": "Butuan City, Philippines",
            "Hotel 7": "Butuan City, Philippines",
            "Hotel 8": "Butuan City, Philippines",
        };

        $('#availabilityModal').find('#hotel-location').val(hotelLocations[hotelName]);
    });

    // New functionality for See in Maps button
    $('#see-map-btn').on('click', function() {
        const location = $('#hotel-location').val();
        const mapUrl = `https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q=${encodeURIComponent(location)}`; // Replace YOUR_API_KEY with your Google Maps API key
        $('#map-iframe').attr('src', mapUrl); // Set the iframe src to the map URL
        $('#mapModal').modal('show'); // Show the map modal
    });

    // Clear iframe when closing the map modal
    $('#mapModal').on('hidden.bs.modal', function () {
        $('#map-iframe').attr('src', ''); // Clear the iframe source on close to stop loading
    });

    // Availability form submit
    $('#availability-form').on('submit', function(e) {
        e.preventDefault();
        alert('Checking availability for ' + $('#selected-hotel').val());
        $('#availabilityModal').modal('hide');
        
        // Show the confirm button after availability is checked
        $('#confirm-btn').show();
    });

    // Confirm button functionality
    $('#confirm-btn').on('click', function() {
        var hotelName = $('#selected-hotel').val();
        alert('You have confirmed your booking for ' + hotelName);
        $('#availabilityModal').modal('hide');
        
        // Optionally, you can redirect to a booking confirmation page or reset the form
        // window.location.href = 'confirmation-page.html';
    });

    // Arrow toggle functionality for Browse button
    document.getElementById('browse-btn').addEventListener('click', function() {
        var arrow = document.querySelector('#arrow-container .arrow-down, #arrow-container .arrow-up');
        var hotelListSection = document.getElementById('hotel-list-section');
        
        // Toggle arrow direction
        if (arrow.classList.contains('arrow-down')) {
            arrow.classList.remove('arrow-down');
            arrow.classList.add('arrow-up');
        } else {
            arrow.classList.remove('arrow-up');
            arrow.classList.add('arrow-down');
        }
    
        // Show or hide hotel list section
        if (hotelListSection.style.display === 'none' || hotelListSection.style.display === '') {
            hotelListSection.style.display = 'block';
        } else {
            hotelListSection.style.display = 'none';
        }
    });
    $(document).ready(function() {
        $('#availability-form').on('submit', function(e) {
            e.preventDefault();
            
            // Perform your availability check logic here
            alert('Checking availability for ' + $('#selected-hotel').val());
            
            // Keep the modal open by not hiding it
            // Now show the confirm button after checking availability
            $('#confirm-btn').show();
        });
    
        $('#confirm-btn').on('click', function() {
            const selectedHotel = $('#selected-hotel').val();
            alert('Booking confirmed for ' + selectedHotel);
    
            // Reset the form, hide confirm button, and close the modal
            $('#availability-form')[0].reset();
            $('#confirm-btn').hide();
            $('#availabilityModal').modal('hide'); // Close the modal after confirming
        });
    
        // Ensure confirm button is hidden by default
        $('#confirm-btn').hide();
    });
    
});
