<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Weather;


class WeatherController extends Controller
{
    public function getWeather(Request $request)
{
    $country = $request->input('country');
    $apiKey = env('WEATHER_API_KEY');
    $url = "http://api.openweathermap.org/data/2.5/forecast?q={$country}&appid={$apiKey}";

    $response = Http::get($url);
    $weatherData = $response->json();

    if (isset($weatherData['city']) && isset($weatherData['list'][0])) {
        $cityName = $weatherData['city']['name'];
        $temperature = $weatherData['list'][0]['main']['temp'] - 273.15;
        $humidity = $weatherData['list'][0]['main']['humidity'];
        $description = $weatherData['list'][0]['weather'][0]['description'];

        // Insérer les données dans la base de données
        Weather::create([
            'city_name' => $cityName,
            'temperature' => $temperature,
            'humidity' => $humidity,
            'description' => $description,
        ]);
    }

    if (isset($weatherData['city'])) {
        // Return the weather data as a partial HTML fragment
        return view('weather', compact('weatherData'));
    } else {
        return response()->json(['error' => 'Le pays sélectionné est invalide ou non trouvé.'], 400);
    }
}
}