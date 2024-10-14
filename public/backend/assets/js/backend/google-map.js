function initAutocomplete(inputId) {
    const input = document.getElementById(inputId);
    const autocomplete = new google.maps.places.Autocomplete(input, {
        // types: ['(cities)']
    });

    autocomplete.addListener("place_changed", function () {
        const place = autocomplete.getPlace();

        if (place.place_id) {
            $(`#${inputId}-place-id`).val(place.place_id);
            $(`#${inputId}-address`).val(place.formatted_address);
            $(`#${inputId}-latitude`).val(place.geometry.location.lat());
            $(`#${inputId}-longitude`).val(place.geometry.location.lng());

            // Extract the city name from the place object
            let city = '';
            for (const component of place.address_components) {
                if (component.types.includes('locality')) {
                    city = component.long_name;
                    break;
                }
            }
            if (city) {
                $(`#${inputId}-city-name`).val(city);
            } else {
                $(`#${inputId}-city-name`).val('');
            }
        } else {
            console.log("No place ID available for the selected place.");
        }
    });
}

function getPlaceDetails(inputId, placeId) {
    const service = new google.maps.places.PlacesService(document.createElement('div'));
    service.getDetails({
        placeId: placeId
    }, function (details, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            $(`#${inputId}`).val(details.formatted_address);
            // const lat = details.geometry.location.lat();
            // const lng = details.geometry.location.lng();
        } else {
            console.error("Place details request failed:", status);
        }
    });
}
