<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Display the weather information for a specific city.
     */
    public function show(City $city)
    {
        $form = $city->forms()->latest()->first();

        if (!$form || !$form->latitude || !$form->length) {
            return response()->json([
                'error' => trans('cities.weather.no-coordinates', ['city' => $city->name])
            ], 404);
        }

        /*
        * Realiza una solicitud a la API de OpenWeatherMap para obtener la información del clima.
        * @param \App\Models\City $city - La ciudad para la cual se consulta el clima.
        * @return \Illuminate\Http\JsonResponse
        */ 
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'lat'   => $form->latitude,
            'lon'   => $form->length,
            'appid' => config('services.openweather.key'),
            'units' => 'metric',
            'lang'  => 'es',
        ]);

        if ($response->failed()) {
            return response()->json([
                'error' => trans('cities.weather.error')
            ], 502);
        }

        $data = $response->json();

        /*
        * Devuelve la información del clima en formato JSON.
        * @return \Illuminate\Http\JsonResponse
        */
        return response()->json([
            'city'         => $city->name,
            'temperature'  => round($data['main']['temp']),
            'feels_like'   => round($data['main']['feels_like']),
            'humidity'     => $data['main']['humidity'],
            'wind_speed'   => $data['wind']['speed'] ?? 0,
            'rain'         => $data['rain']['1h'] ?? 0,
            'description'  => $data['weather'][0]['description'],
            'icon'         => $data['weather'][0]['icon'],
        ]);
    }
}