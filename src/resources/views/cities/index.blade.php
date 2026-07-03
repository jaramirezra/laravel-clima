<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clima por ciudad</title>
    @vite(['resources/js/cities/main.js'])
</head>
<body class="p-6 bg-gray-100">

    <h1 class="text-2xl font-bold mb-4">Consulta el clima por ciudad</h1>

    <select id="city-select" class="border p-2 rounded">
        <option value="">Selecciona una ciudad</option>
        @foreach($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
    </select>

    <div id="weather-widget" class="mt-6 hidden bg-white rounded-lg shadow p-6 max-w-sm">
        <h2 id="w-city" class="text-xl font-bold"></h2>
        <img id="w-icon" src="" alt="icono clima" class="w-20 h-20">
        <p class="text-4xl font-bold" id="w-temp"></p>
        <p class="capitalize text-gray-600" id="w-description"></p>
        <ul class="mt-3 text-sm text-gray-500 space-y-1">
            <li>Sensación térmica: <span id="w-feels"></span>°C</li>
            <li>Humedad: <span id="w-humidity"></span>%</li>
            <li>Viento: <span id="w-wind"></span> m/s</li>
            <li>Lluvia (última hora): <span id="w-rain"></span> mm</li>
        </ul>
    </div>

    <div id="weather-error" class="mt-4 text-red-600 hidden"></div>

</body>
</html>