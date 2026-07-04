<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ __('cities.cities.title') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @vite(['resources/css/app.css', 'resources/css/forms/style.css', 'resources/js/app.js', 'resources/js/cities/main.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 color-container">
    <div class="container-fluid">
        <div class="list-form mt-5">

        <h1 class="text-2xl font-bold mb-4">{{ __('cities.cities.title') }}</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <label for="city-select" class="form-label">{{ __('cities.cities.select-city') }}</label>
                    <select id="city-select" class="border p-2 rounded">
                        <option value="">{{ __('cities.cities.select-city') }}</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">

                    <div class="card text-center">
                    <div class="card-header">
                        {{ __('cities.cities.info') }}
                    </div>
                    <div class="card-body">
                        <div id="weather-loader" class="d-none py-4" role="status" aria-live="polite">
                            <div class="spinner-border text-primary" aria-hidden="true"></div>
                            <div class="mt-2">{{ __('cities.cities.loading') }}</div>
                        </div>
                        <div id="weather-widget" >
                            <h2 id="w-city" class="text-xl font-bold"></h2>

                            <figure class="figure">
                                <img src="" id="w-icon" class="figure-img img-fluid rounded w-20 h-20">
                                <figcaption class="figure-caption">A caption for the above image.</figcaption>
                            </figure>
                        
                            <p class="text-4xl font-bold" id="w-temp"></p>
                            <p class="capitalize text-gray-600" id="w-description"></p>

                            <ul class="mt-4 list-unstyled text-gray-700">
                                <li><i class="fa fa-arrow-right" aria-hidden="true"></i> {{ __('cities.cities.feels-like') }}: <span id="w-feels"></span>°C</li>
                                <li><i class="fa fa-arrow-right" aria-hidden="true"></i> {{ __('cities.cities.humidity') }}: <span id="w-humidity"></span>%</li>
                                <li><i class="fa fa-arrow-right" aria-hidden="true"></i> {{ __('cities.cities.wind-speed') }}: <span id="w-wind"></span> m/s</li>
                                <li><i class="fa fa-arrow-right" aria-hidden="true"></i> {{ __('cities.cities.rain') }}: <span id="w-rain"></span> mm</li>
                            </ul>
                        </div>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>

        <div id="weather-error" class="mt-4 text-red-600 hidden"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const successMessage = @json(session('success'));
            const errorMessages = @json($errors->all());

            if (successMessage && window.Swal) {
                Swal.fire({
                    icon: 'success',
                    title: @json(__('cities.alerts.success_title')),
                    text: successMessage,
                    confirmButtonText: @json(__('cities.alerts.confirm')),
                });
            }

            if (errorMessages.length > 0 && window.Swal) {
                Swal.fire({
                    icon: 'error',
                    title: @json(__('cities.alerts.error_title')),
                    text: errorMessages.join('\n'),
                    confirmButtonText: @json(__('cities.alerts.confirm')),
                });
            }
        });
    </script>
</body>
</html>