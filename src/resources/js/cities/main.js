document.addEventListener('DOMContentLoaded', () => {
    const select = document.querySelector('#city-select');
    const widget = document.querySelector('#weather-widget');
    const errorBox = document.querySelector('#weather-error');

    if (!select) return;

    select.addEventListener('change', async (e) => {
        const cityId = e.target.value;
        errorBox.classList.add('hidden');
        widget.classList.add('hidden');

        if (!cityId) return;

        try {
            const res = await fetch(`/cities/${cityId}/weather`);
            const data = await res.json();

            if (!res.ok) {
                errorBox.textContent = data.error || 'Error al consultar el clima.';
                errorBox.classList.remove('hidden');
                return;
            }

            document.querySelector('#w-city').textContent = data.city;
            document.querySelector('#w-icon').src = `https://openweathermap.org/img/wn/${data.icon}@2x.png`;
            document.querySelector('#w-temp').textContent = `${data.temperature}°C`;
            document.querySelector('#w-description').textContent = data.description;
            document.querySelector('#w-feels').textContent = data.feels_like;
            document.querySelector('#w-humidity').textContent = data.humidity;
            document.querySelector('#w-wind').textContent = data.wind_speed;
            document.querySelector('#w-rain').textContent = data.rain;

            widget.classList.remove('hidden');
        } catch (err) {
            errorBox.textContent = 'Error de conexión al consultar el clima.';
            errorBox.classList.remove('hidden');
        }
    });
});