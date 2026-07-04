document.addEventListener('DOMContentLoaded', () => {
    const select = document.querySelector('#city-select');
    const widget = document.querySelector('#weather-widget');
    const loader = document.querySelector('#weather-loader');
    const errorBox = document.querySelector('#weather-error');

    if (!select) return;

    /*
    * Muestra un mensaje de error relacionado con el clima.
    * @param {string} message - El mensaje de error a mostrar.
    */
    const showWeatherError = (message) => {
        errorBox.textContent = message;
        errorBox.classList.remove('hidden');

        if (window.Swal) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message,
                confirmButtonText: 'Aceptar',
            });
        }
    };

    /*
    * Maneja el evento de cambio en el select de ciudades.
    * @param {Event} e - El evento de cambio.
    */
    select.addEventListener('change', async (e) => {
        const cityId = e.target.value;
        errorBox.classList.add('hidden');
        widget.classList.add('hidden');
        loader?.classList.remove('d-none');

        if (!cityId) {
            loader?.classList.add('d-none');
            return;
        }

        try {
            const res = await fetch(`/cities/${cityId}/weather`);
            const data = await res.json();

            if (!res.ok) {
                loader?.classList.add('d-none');
                showWeatherError(data.error || 'Error al consultar el clima.');
                return;
            }

            document.querySelector('#w-city').textContent = data.city;
            document.querySelector('#w-icon').src = `https://openweathermap.org/img/wn/${data.icon}@2x.png`;
            document.querySelector('#w-temp').textContent = `${data.temperature}\u00B0C`;
            document.querySelector('#w-description').textContent = data.description;
            document.querySelector('#w-feels').textContent = data.feels_like;
            document.querySelector('#w-humidity').textContent = data.humidity;
            document.querySelector('#w-wind').textContent = data.wind_speed;
            document.querySelector('#w-rain').textContent = data.rain;

            loader?.classList.add('d-none');
            widget.classList.remove('hidden');
        } catch (err) {
            loader?.classList.add('d-none');
            showWeatherError('Error de conexion al consultar el clima.');
        }
    });
});