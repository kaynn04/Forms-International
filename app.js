var config = {
    cUrl: 'https://api.countrystatecity.in/v1/countries',
    ckey: 'NHhvOEcyWk50N2Vna3VFTE00bFp3MjFKR0ZEOUhkZlg4RTk1MlJlaA=='
}


var countrySelect = document.querySelector('.country'),
    stateSelect = document.querySelector('.state'),
    citySelect = document.querySelector('.city')


function loadCountries() {

    let apiEndPoint = config.cUrl

    fetch(apiEndPoint, {headers: {"X-CSCAPI-KEY": config.ckey}})
    .then(Response => Response.json())
    .then(data => {
        // console.log(data);

        data.forEach(country => {
            const option = document.createElement('option')
            option.value = country.iso2
            option.textContent = country.name 
            countrySelect.appendChild(option)
        })
    })
    .catch(error => console.error('Error loading countries:', error))

    stateSelect.disabled = true
    citySelect.disabled = true
    stateSelect.style.pointerEvents = 'none'
    citySelect.style.pointerEvents = 'none'
}



function loadStates() {
    stateSelect.disabled = false;
    citySelect.disabled = true;
    stateSelect.style.pointerEvents = 'auto';
    citySelect.style.pointerEvents = 'none';

    const selectedCountryCode = countrySelect.value;
    // console.log(selectedCountryCode);
    stateSelect.innerHTML = '<option value="">Select State</option>'; // for clearing the existing states
    citySelect.innerHTML = '<option value="">Select City</option>'; // Clear existing city options

    fetch(`${config.cUrl}/${selectedCountryCode}/states`, { headers: { "X-CSCAPI-KEY": config.ckey } })
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                // Add a default option when there's no data
                const option = document.createElement('option');
                option.value = 'N/A';
                option.textContent = 'No data available';
                stateSelect.appendChild(option);
            } else {
                data.forEach(state => {
                    const option = document.createElement('option');
                    option.value = state.iso2;
                    option.textContent = state.name;
                    stateSelect.appendChild(option);
                });
            }
        })
        .catch(error => console.error('Error loading countries:', error));
}


function loadCities() {
    citySelect.disabled = false;
    citySelect.style.pointerEvents = 'auto';

    const selectedCountryCode = countrySelect.value;
    const selectedStateCode = stateSelect.value;
    // console.log(selectedCountryCode, selectedStateCode);

    citySelect.innerHTML = '<option value="">Select City</option>'; // Clear existing city options

    fetch(`${config.cUrl}/${selectedCountryCode}/states/${selectedStateCode}/cities`, { headers: { "X-CSCAPI-KEY": config.ckey } })
        .then(response => response.json())
        .then(data => {
            const isNoDataState = stateSelect.options[stateSelect.selectedIndex].text === 'No data available';

            if (!data || data.length === 0 || isNoDataState) {
                // Add a default option when there's no data or the state has 'No data available'
                const option = document.createElement('option');
                option.value = 'N/A';
                option.textContent = 'No data available';
                citySelect.appendChild(option);
            } else {
                data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.iso2;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            }
        });
}

window.onload = loadCountries