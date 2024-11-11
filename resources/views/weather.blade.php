<!-- resources/views/partials/weather.blade.php -->

<h1 class="text-center mb-4">Météo pour {{ $weatherData['city']['name'] }}</h1>
@if(isset($weatherData['list'][0]['main']['temp']))
    <p>Température : {{ $weatherData['list'][0]['main']['temp'] - 273.15 }} °C</p>
@else
    <p>Température non disponible</p>
@endif

@if(isset($weatherData['list'][0]['main']['humidity']))
    <p>Humidité : {{ $weatherData['list'][0]['main']['humidity'] }} %</p>
@else
    <p>Humidité non disponible</p>
@endif

@if(isset($weatherData['list'][0]['weather'][0]['description']))
    <p>Description : {{ $weatherData['list'][0]['weather'][0]['description'] }}</p>
@else
    <p>Description non disponible</p>
@endif
